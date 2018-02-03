<?php
	global $post;
	$small_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
?>
<!--head start-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/assets/images/favicon.png">
  <link rel="image_src" href="<?php echo $small_image[0]; ?>" />
  <?php	gravity_form_enqueue_scripts( 1, true ); ?>
  <meta property="og:image" content="<?php echo $small_image[0]; ?>" />
  <?php if( is_page() && get_field('image') ) { ?>
    <style type="text/css">
      #top {
        background-image: url('<?php the_field('image'); ?>');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: <?php the_field('image_position'); ?>;
      }
    </style>
  <?php } ?>
  <?php if( is_single() ) { ?>
    <style type="text/css">
      <?php 
      if( get_field('banner_background') ) {
        $image_url = get_field('banner_background');
      }elseif( has_post_thumbnail( $post->ID ) ){
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        $image_url = $image[0];
      }else{
        $image_url = '';
      }
      ?>
      #top {
        background: url('<?php echo $image_url; ?>') 50% 50% no-repeat;
        background-size: cover;
      }
      #top .container {
        text-align: <?php the_field('banner_image_alignment'); ?>;
      }
    </style>
  <?php } ?>
  <?php wp_head(); ?>
</head>
<!--head end-->
