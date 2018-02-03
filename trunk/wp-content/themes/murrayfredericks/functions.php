<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',  // Scripts and stylesheets
  'lib/extras.php',  // Custom functions
  'lib/setup.php',   // Theme setup
  'lib/titles.php',  // Page titles
  'lib/follow-custom.php',  //  Follow Custom Functions
  'lib/customizer.php',     //  Theme customizer
  'lib/plugins.php',        //  Auto Install Standard Plugins
  'lib/acf.php',             //  Auto Save/Load ACF JSON
  'lib/custom-post-type.php', //  Custom post types
  'lib/custom-taxonomy.php', //  Custom taxonomy
  'lib/wrapper.php'  // Theme wrapper class
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

add_filter( 'gform_field_content', 'bootstrap_styles_for_gravityforms_fields', 10, 5);
function bootstrap_styles_for_gravityforms_fields($content, $field, $value, $lead_id, $form_id){
  
    // Currently only applies to most common field types, but could be expanded.
  
  if( !is_admin() ){
      if($field["type"] == 'name' || $field["type"] == 'address' || $field["type"] == 'text' || $field["type"] == 'email' ) {
          $content = str_replace('<input ', '<input class=\'form-control\' ', $content);
      }
    
      if($field["type"] == 'select') {
          $content = str_replace('gfield_select', 'form-control gfield_select', $content);
      }

      if($field["type"] == 'textarea') {
          $content = str_replace('class=\'textarea', 'class=\'form-control textarea', $content);
      }
    
      if($field["type"] == 'checkbox') {
          $content = str_replace('li class=\'', 'li class=\'checkbox ', $content);
          $content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
      }
    
      if($field["type"] == 'radio') {
          $content = str_replace('li class=\'', 'li class=\'radio ', $content);
          $content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
      }

      $content = str_replace('gfield_description', 'gfield_description help-block', $content);
  }  
  return $content;
  
}

add_filter( 'gform_field_css_class', 'bootstrap_styles_for_gravityforms_classes', 10, 3);
function bootstrap_styles_for_gravityforms_classes($classes, $field, $form){
  if( !is_admin() ){
    $classes .= $field->failed_validation ? ' has-error' : '';
    if($field['type'] == 'button'){
        $classes .= ' btn';
    }  
  }
  return $classes;
}

add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {
  if( !is_admin() ){
    if( $form['id'] == 1 ) {
      return '<button class="button btn" id="gform_submit_button_'.$form['id'].'">'.__( 'Apply Now', 'gravityforms' ).'</button>';
    }elseif( $form['id'] == 3 ) {
      return '<button class="button btn" id="gform_submit_button_'.$form['id'].'">'.__( 'Subscribe', 'gravityforms' ).'</button>';
    }else {
      return '<button class="button btn" id="gform_submit_button_'.$form['id'].'">'.__( 'Submit', 'gravityforms' ).'</button>';
    }
  }
}

add_filter( 'gform_validation_message', 'change_message', 10, 2 );
function change_message( $message, $form ) {
  if( !is_admin() ){
    return '<div class="validation_error alert alert-danger">' . __( 'There was a problem with your submission.', 'gravityforms' ) . ' ' . __( 'Errors have been highlighted below.', 'gravityforms' ) . '</div>';
  }
}

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

add_filter('gform_init_scripts_footer', '__return_true');

function fa_func( $atts ) {
  $atts = shortcode_atts( array(
    'icon'    => '',
    'link'    => '',
    'xclass'  => ''
  ), $atts );
  $html = '';
  if( $atts['link'] ) {
    $html .= '<a href="'.$atts['link'].'" target="_blank">';
  }
  $html .= '<i class="fa fa-'.$atts['icon'].' '.$atts['xclass'].'"></i>';
  if( $atts['link'] ) {
    $html .= '</a>';
  }
  return $html;
}
add_shortcode( 'fa', 'fa_func' );




function team_func( $atts ) {
  $the_query = new WP_Query( array( 'post_type' => 'team', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order title' ) );
  $html = '';
  if ( $the_query->have_posts() ) {
  	$html .= '<div class="team_list row">';
  	while ( $the_query->have_posts() ) {
  		$the_query->the_post();
    $html .= '<div class="col-md-3 col-lg-2 col-sm-6 col-xs-6"><div class="wrap" data-toggle="modal" data-target="#team-'.basename(get_permalink()).'">';
    
    if ( has_post_thumbnail() ) {
      $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
      $html .=  '<div class="team_avatar"><img src="'.$featured_img_url.'" class="img-circle"/></div>';
    }
    else {
      $html .=  '<div class="team_avatar"><img src="http://via.placeholder.com/101x101" class="img-circle"/></div>';
    } 
    $html .= '<div class="vmiddle">';
    $html .= '<div class="team_fullname">'.get_the_title().'</div>';
			$html .= '<div class="position"><p>'.get_field('designation').'</p></div>';
		$html .= '</div></div></div>';
  	}
  	$html .= '</div>';
  }
  if ( $the_query->have_posts() ) {
  	while ( $the_query->have_posts() ) {
  		$the_query->the_post();
		$html .= '<div class="modal team-modal fade" id="team-'.basename(get_permalink()).'" tabindex="-1" role="dialog" aria-labelledby="team-'.basename(get_permalink()).'Label">';
			$html .= '<div class="modal-dialog" role="document">';
				$html .= '<div class="modal-content">';
					$html .= '<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACxklEQVR4XtXb61WDMBiA4VwGsJvI6QLqBrqJTqKb6AatG+AmOkASTziEA0kouXxfLv7Eqn0fA5RAKPF8DcMwcM7fhRAv4zj++l7Ty7ZhGE6c808hxNs4jqP9vqm9Qcczxi6U0hMhZBRCPPWKMMdfCCGDUupXSqlbNggbACve2HSJsI43IT6EBWAnvksEX/wewgRwEN8Vwq14HwINjO8CISTeRqDn8/lKKX2IOKo3eUyIiV8hfOsRcGKMaYT7XhES43+klI/mGNAtQk68Pr2vzwLdIeTG6xFvfw7oBgEi3gGYT4nNI0DFewFaR4CM3wVoFQE6/iZAawgY8YcArSBgxQcB1EbAjA8GqIWAHR8FUBqhRHw0QCmEUvFJANgIJeOTAbAQSsdnAUAj1IjPBoBCqBUPApCLoH+ecz5NXYdOyCilpskMiOl6575A6JuwX5c6szT/nirxYCPAYCQiBJtD/ufNHwUbAdgIGPHgIwALASseDSDjwOjsDpjxqAAQCNjx6AA5CCXiiwHEnufn/aDIHSjws8B6J075hGcdBNAR0AAA4o0FKgIKAGA8OgI4AEI8KgIoAGI8GgIYQEq8PtVNp6KKt+ZBAFLj9SWtBqj5fEI2QE68uZ5PvIoEOTtkAUDEZ15AZSMkA0DG10RIAsCIr4UQDYAZXwMhCqBEfGmEYICS8SURggBqxJdCOASoGV8C4SZAC/HYCLsALcVjIngBWozHQvAtmdFrbKrdq3PmxT0bIK8dnEdlW4+HHgmbh6V7iYdEWB6X7y0eCmFaMNFrPARC9JKZUndsQg6G9j2I2JklpdS0ZEavEr0SQu6O/mir8Ykj4U8IsSyZOURoPT4SYYrXq0g3Cyf3RkIv8YEIS/w0I23tR85I6C3+AGET7wDoDetjQq/xOwhOvBfAIDDGPqSUzxCPoh0dXDG/P39s/pJSvvqWz/8DsuWI6Z0ahlgAAAAASUVORK5CYII="/></span></button></div>';
					$html .= '<div class="modal-body text-center"><div class="container">';
						$html .= '<h2>'.get_the_title().'</h2>';
						if( get_field('designation') ) {
							$html .= '<h3>'.get_field('designation').'</h3>';
						}
						$html .= get_the_content();
						if( get_field('phone') || get_field('email') ) {
							$html .= '<h3><strong>Get in touch</strong></h3>';
							if( get_field('phone') ) {
								$html .= '<div><a href="tel:'.get_field('phone').'">'.get_field('phone').'</a></div>';
							}
							if( get_field('email') ) {
								$html .= '<div><a href="mailto:'.get_field('email').'">'.get_field('email').'</a></div>';
							}
						}
					$html .= '</div></div>';
				$html .= '</div>';
			$html .= '</div>';
		$html .= '</div>';
  	}
  }
  wp_reset_postdata();
  return $html;
}
add_shortcode( 'team', 'team_func' );

function logos_func( $atts ) {
  global $post;
  $html = '';
  if( have_rows('logo_repeat',$post->ID) ) {
    $html .= '<div class="logos row">';
    while ( have_rows('logo_repeat',$post->ID) ) : the_row();
      $html .= '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">';
        if( get_sub_field('url') ) {
          $html .= '<a href="'.get_sub_field('url').'" target="_blank">';
        }
        $html .= '<img src="'.get_sub_field('logo').'" class="aligncenter" />';
        if( get_sub_field('url') ) {
          $html .= '</a>';
        }
      $html .= '</div>';
    endwhile;
    $html .= '</div>';
  }
  return $html;
}
add_shortcode( 'logos', 'logos_func' );


function share_func( $atts ) {
  global $post;
  $small_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
  $html = '';
  $html .= '<p class="share">';
  $html .= '<span class="st_facebook_custom" st_title="'.$post->post_title.'" st_summary="'.$post->post_excerpt.'" st_image="'.$small_image[0].'" displayText="Facebook"></span>';
  $html .= '<span class="st_twitter_custom" st_title="'.$post->post_title.'" st_summary="'.$post->post_excerpt.'" st_image="'.$small_image[0].'" displayText="Tweet"></span>';
  $html .= '<span class="st_googleplus_custom" st_title="'.$post->post_title.'" st_summary="'.$post->post_excerpt.'" st_image="'.$small_image[0].'" displayText="Google +"></span>';
  if( is_singular('work') ){
    $html .= '<span class="st_email_custom" st_title="'.$post->post_title.'" st_summary="'.$post->post_excerpt.'" st_image="'.$small_image[0].'" displayText="Email"></span>';
  }else{
    $html .= '<span class="st_linkedin_custom" st_title="'.$post->post_title.'" st_summary="'.$post->post_excerpt.'" st_image="'.$small_image[0].'" displayText="LinkedIn"></span>';
  }
  $html .= '<script type="text/javascript">var switchTo5x=true;</script><script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher: "32ae9ff6-93e1-4428-9772-72735858587d", doNotHash: true, doNotCopy: true, hashAddressBar: false});</script>';
  $html .= '</p>';
  return $html;
}
add_shortcode( 'share', 'share_func' );

remove_filter( 'acf_the_content', 'wpautop' );
add_filter( 'acf_the_content', 'wpautop' , 99);
add_filter( 'acf_the_content', 'shortcode_unautop',100 );
remove_filter('acf_the_content', 'wptexturize');

add_filter( 'acf_the_content', 'remove_empty_p', 999, 1 );
function remove_empty_p( $content ){
  // clean up p tags around block elements
  $content = preg_replace( array(
    '#<p>\s*<(div|aside|section|article|header|footer)#',
    '#</(div|aside|section|article|header|footer)>\s*</p>#',
    '#</(div|aside|section|article|header|footer)>\s*<br ?/?>#',
    '#<(div|aside|section|article|header|footer)(.*?)>\s*</p>#',
    '#<p>\s*</(div|aside|section|article|header|footer)#',
  ), array(
    '<$1',
    '</$1>',
    '</$1>',
    '<$1$2>',
    '</$1',
  ), $content );
  return preg_replace('#<p>(\s|&nbsp;)*+(<br\s*/*>)*(\s|&nbsp;)*</p>#i', '', $content);
}

function custom_classes( $classes ) {
  global $post;
  if( get_post_type( get_the_ID() ) == 'post' && !is_single() ) {
    $classes[] = 'col-md-6';
  }
  return $classes;
}
add_filter( 'post_class', 'custom_classes' );

/*function type_scripts() {
  wp_register_script( 'Type', 'http://seanmurphy.eu/portfolio/scripts/typed.min.js', null, null, true );
  wp_enqueue_script('Type');
  }
   
  add_action( 'wp_enqueue_scripts', 'type_scripts' ); */

