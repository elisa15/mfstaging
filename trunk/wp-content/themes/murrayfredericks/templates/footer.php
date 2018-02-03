<!--GETINTOUCHFORM Start-->
<?php
$getintouch_page = get_page_by_title( 'Get-in-touch-form' );
$getintouch_page_id = $getintouch_page->ID;
$postcontents = get_post($getintouch_page_id);
$content = get_post_field('post_content', $getintouch_page_id);
$postobject = get_field('select_pages_where_to_display',$getintouch_page_id);
$posttypeobject = get_field('select_service_post_where_to_display',$getintouch_page_id);
if(is_page($postobject) || is_single($posttypeobject)){
   ?>
   <section class="getintouch">
    <div class="container">
      <div class="shell">
            <div class="section-content row">
                  <div class="col-md-6 col-xs-12">
                      <div class="shell">
                        <?php 
                        echo $content;
                       ?>
                       </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                        <?php
                        $getintouchshortcode = get_field('gravity_form_shortcode',$getintouch_page_id);
                        echo do_shortcode(''.$getintouchshortcode.'');
                        ?>
                  </div>
            </div>
      </div>
    </div>
</section>
   <?php
}
?>
<!--GETINTOUCHFORM End-->
  <!--CTA Start-->
  <?php
  $cta_page = get_page_by_title( 'CTA' );
  $cta_page_id = $cta_page->ID;
  $showthis_cta = get_field('display_this_on_single_page',$cta_page_id);  
  $post_content = get_post($cta_page_id);
  $bg_color = get_field('background_colour',$cta_page_id);
  $cta_postobject = get_field('select_pages_where_to_display',$cta_page_id);
  if(is_singular('work') || is_page($cta_postobject)){
  if( $showthis_cta ):?>
  <section id="" class="additional-content content-5 cta text-center" style="background:<?=$bg_color?>">
      <div class="container">
                  <?php echo $post_content->post_content;?>
              <?php if( get_field('button_title',$cta_page_id) ) { ?>
              <a href="#">
                  <?php the_field('button_title',$cta_page_id); ?>
              </a>
              <?php } ?>
      </div>
  </section>
  </div>
  <?php endif;}?>
  <!--CTA End-->
<footer class="content-info">
  <div class="buckets">
      <?php get_template_part('templates/footercontent', 'page'); ?>
  </div>
</footer>
<script src='http://seanmurphy.eu/portfolio/scripts/typed.min.js'></script>
