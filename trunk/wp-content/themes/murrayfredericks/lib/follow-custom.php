<?php

//Add custom functions here//

function work_func( $atts ) {
    global $post;
    $atts = shortcode_atts( array(
      'posts_per_page'    => '-1',
      'random'            => ''
    ), $atts );
    if( $atts['random'] == 1 ) {
      $order = 'rand';
    }else{
      $order = 'menu_order title';
    }
    $the_query = new WP_Query( array( 'post_type' => 'work', 'posts_per_page' => $atts['posts_per_page'], 'post__not_in' => array($post->ID), 'order' => 'ASC', 'orderby' => $order ) );
    $html = '';
    $html .= '<div class="works-filter dropdown">';
      $html .= '<button class="btn dropdown-toggle" type="button" id="dropdownFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Filter <label>Show All</label><i class="fa fa-angle-down"></i></button>';
      $html .= '<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownFilter">';
        $html .= '<li class="is-checked" data-filter="*">Show All</li>';
        $categories = get_terms( 'work_categories', array( 'hide_empty' => false ) );
        if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
          foreach ( $categories as $term ) {
            $html .= '<li data-filter=".'.$term->slug.'">'.$term->name.'</li>';
          }
        }
      $html .= '</ul>';
    $html .= '</div><div class="clearfix"></div>';
    if ( $the_query->have_posts() ) {
      $html .= '<div class="works-list row">';
      while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $terms = get_the_terms( get_the_ID(), 'work_categories' );
        if ( $terms && ! is_wp_error( $terms ) ) {
          $cats = array();
          foreach ( $terms as $term ) {
            $cats[] = $term->slug;
          }
          $classes = join( ' ', $cats );
        }
        $html .= '<div class="col-sm-6 col-lg-4 text-center '.$classes.'">';
          $html .= '<div class="wrap" onclick="window.location=\''.get_permalink().'\'">';
            if( has_post_thumbnail() ) {
              $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' );
              $image_url = $image[0];
            }elseif( get_field('banner_background') ){
              $image_url = get_field('banner_background');
            }else{
              $image_url = 'http://placehold.it/450x367';
            }
            //$html .= '<div class="featured" style="background-image: url(\''.$image_url.'\'); background-size: cover;"><div class="eye"></div></div>';
            $html .= '<div class="featured"><img src="'.$image_url.'" alt="'.get_the_title().'" /><div class="eye"></div></div>';
            $html .= '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
            if( get_the_excerpt() ) {
              $html .= '<p>'.get_the_excerpt().'</p>';
            }
          $html .= '</div>';
        $html .= '</div>';
      }
      $html .= '</div>';
    }else{
      $html .= '<p>No such result.</p>';
    }
    wp_reset_postdata();
    return $html;
  }
  add_shortcode( 'work', 'work_func' );

