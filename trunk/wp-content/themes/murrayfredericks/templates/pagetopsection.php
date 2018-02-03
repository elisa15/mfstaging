<div id="top">
  <?php if( is_home() || is_archive() || is_category() ) { ?>
    <?php
      if (is_category()) {
        $category = get_category(get_query_var('cat'));
        $cat_id = $category->cat_ID;
      }else{
        $cat_id = 0;
      }
    ?>
    <?php $the_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 5, 'cat' => $cat_id ) ); ?>
    <?php if ( $the_query->have_posts() ) { ?>
    <div class="slider">
      <div class="swiper-container">
        <div class="swiper-wrapper">
          <?php while ( $the_query->have_posts() ) { $the_query->the_post(); ?>
          <?php $featured = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
          <div class="swiper-slide"<?php echo $featured ? ' style="background: url('.$featured[0].') 50% 50% no-repeat; background-size: cover;"' : ''; ?>>
            <div class="container">
              <div class="wrap">
                <?php if( is_home() ) { ?>
                <div class="subtitle" data-swiper-parallax="-100"><span>Blog</span></div>
                <?php } ?>
                <h1 data-swiper-parallax="-500"><?php the_title(); ?></h1>
                <p class="readmore" data-swiper-parallax="-1000"><a href="<?php the_permalink(); ?>" class="btn">Read</a></p>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
    </div>
    <?php } wp_reset_postdata(); ?>
  <?php }else{ ?>
    <div class="container">
      <?php if( get_field('text') ) { ?>
        <div class="wrap"><?php the_field('text'); ?></div>
      <?php } ?>
      <?php
          if(is_front_page()):
            $pageID = get_the_ID();
      ?>
          <section class="intro">
                  <?php
                  if( have_rows('type_strings',$pageID) ):
                      while ( have_rows('type_strings',$pageID) ) : the_row();
                              $arr[] = get_sub_field('type_text',$pageID);
                      endwhile;
                  endif;
                  //print_r($arr);
                  $string = implode(', ', $arr);
                  echo '<div id="typestrings" style="display:none; opacity:0">'.$string.'</div>';
                  echo '<h1 class="typestrings">Want to <br /><emphasis class="typed colorTyped"></emphasis><br /></h1>';
                  ?>
          </section> 
      <?php
          endif;
      ?> 
      <?php if( is_singular( 'post' ) ) { ?>
        <div class="wrap">
          <?php 
          $cats = array();
          foreach(wp_get_post_categories(get_the_ID()) as $c) {
            $cat = get_category($c);
            array_push($cats,'<a href="'. get_bloginfo( 'url' ) . '/category/' . $cat->slug . '/">'.$cat->name.'</a>');
          }
          if(sizeOf($cats)>0) {
            $post_categories = implode(', ',$cats);
          }
          ?>
          <?php if(sizeOf($cats)>0) { ?>
          <div class="subtitle"><?php echo $post_categories; ?></div>
          <?php } ?>
          <h1><?php the_title(); ?></h1>
          <p class="byline author vcard"><?= __('By', 'sage'); ?> <strong><?php the_author_meta('display_name', 1); ?></strong> <span class="sep">|</span> <time class="updated" datetime="<?php echo get_post_time('c', true); ?>"><?php echo get_the_date(); ?></time></p>
        </div>
      <?php } ?>
      <?php if( is_singular( 'services' ) ) { ?>
        <div class="wrap">
          <div class="subtitle">Services</div>
          <h1><?php the_title(); ?></h1>
          </div>
      <?php } ?>
      <?php if( is_singular('work') && get_field('banner_image') ) { ?>
        <div class="wrap"><img src="<?php the_field('banner_image'); ?>" /></div>
      <?php } ?>
      <?php if( is_404() ) { ?>
        <div class="wrap"><h2><a href="<?php bloginfo( 'url' ); ?>">Go home duckie... you're drunk</a></h2></div>
      <?php } ?>    
    </div>
    <div class="pagetoscroll"><a href="#intro"><i class="fa fa-angle-down"></i></a></div>
  <?php } ?>

</div>
