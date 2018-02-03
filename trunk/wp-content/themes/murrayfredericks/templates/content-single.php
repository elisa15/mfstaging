<?php if( is_singular('work') ) { ?>
  <?php while (have_posts()) : the_post(); ?>
      <section class="main-content center">
        <main class="container">
        	<?php if( get_field('title') ) { ?>
        	<h1 class="text-center" itemprop="headline"><?php the_field('title'); ?></h1>
        	<?php }else{ ?>
       		<h1 class="text-center" itemprop="headline"><?php the_title(); ?></h1>
        	<?php } ?>
            <div class="hidden">
              <?php $small_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' ); ?>
              <img itemprop="image" src="<?php echo $small_image[0]; ?>" />
              <div itemprop="description"><?php the_excerpt(); ?></div>
              <div itemprop="datePublished"><?php the_date(); ?></div>
            </div>
            <div class="row description">
            	<div class="col-sm-9">
            		<?php if( get_field('quote') ) { ?>
            		<blockquote itemprop="alternativeHeadline">
            			<?php the_field('quote'); ?>
            		</blockquote>
            		<?php } ?>
                  <div itemprop="articleBody">
              		  <?php the_content(); ?>
                  </div>
              	</div>
	          	<aside class="col-sm-3">
	            	<?php the_field('right_side'); ?>
	          	</aside>
            </div>
            <?php $slider_images = get_field('slider'); ?>
            <?php if( $slider_images ) { ?>
            <div class="gallery">
        		<div class="slider">
		            <div class="swiper-container">
		            	<div class="swiper-wrapper">
		            		<?php foreach( $slider_images as $image ) { ?>
		            		<div class="swiper-slide"><img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" /></div>
		            		<?php } ?>
		            	</div>
		            	<div class="swiper-pagination"></div>
		            	<div class="swiper-button-prev"></div>
		            	<div class="swiper-button-next"></div>
		            </div>
		        </div>
	        </div>
            <?php } ?>
            <?php if( get_field('additional_text') ) { ?>
            <div class="add-text">
            	<?php the_field('additional_text'); ?>
            </div>
            <?php } ?>
        </main>
      </section>
      <?php endwhile; ?>

      <?php } ?>
      <?php if( is_singular('post') ) { ?>
        <section id="related" class="additional-content related">
          <div class="container">
            <h3>You might also like...</h3>
            <div class="row blog-list">
              <?php 
                $tags = wp_get_post_tags($post->ID);
                if ($tags) {
                  $tag_ids = array();
                  foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                  $args = array(
                    'tag__in' => $tag_ids,
                    'post__not_in' => array($post->ID),
                    'posts_per_page'=>3,
                    'orderby' => 'rand',
                    'caller_get_posts'=>1
                  );
                }else{
                  $args = array(
                    'post__not_in' => array($post->ID),
                    'posts_per_page'=>3,
                    'orderby' => 'rand',
                    'caller_get_posts'=>1
                  );
                }
                $my_query = new wp_query( $args );
                while( $my_query->have_posts() ) {
                  $my_query->the_post();
                  get_template_part('templates/content_related', get_post_type() != 'post' ? get_post_type() : get_post_format());
                }
                wp_reset_query();
              ?>
            </div>
          </div>
        </section>
        <section id="newsletter" class="additional-content newsletter">
          <div class="container"><?php echo do_shortcode( '[gravityform id="3" title="true" description="false" ajax="true" tabindex="99"]' ); ?></div>
        </section>
      <?php } ?>
      <?php if( ( is_page() || is_singular('work') ) && have_rows('repeat_contents') ) { $i = 0; ?>
        <?php while ( have_rows('repeat_contents') ) : the_row(); $i++; ?>
          <section id="<?php the_sub_field('id'); ?>" class="additional-content content-<?php echo $i; ?> <?php the_sub_field('classname'); ?>">
            <div class="container">
              <?php the_sub_field('text'); ?>
            </div>
          </section>
          
      <?php endwhile; }?>

<?php if( ( is_singular('services') ) ) {  ?>
  <?php while (have_posts()) : the_post(); ?>
  <section class="section___1">
      <div class="container">
            <div class="shell">
                  <div class="section-content row text-center">
                      <?php if ( has_post_thumbnail() ) : ?>
                      <div class="col-sm-12">
                        <div class="post-thumbnail">
                          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                              <?php the_post_thumbnail(); ?>
                          </a>
                        </div>
                      </div>    
                      <?php endif; ?>
                      <div class="col-sm-12">
                            <?=the_content()?>
                      </div>
                  </div>
            </div>
      </div>
</section>  
<?php endwhile; ?>  
<?php  
// check if the repeater field has rows of data
if( have_rows('repeat_content_block') ):
      ?>
<section class="section___2 key-services-heading">
      <div class="container">
            <div class="shell text-center">
                  <h1><?php the_field('custom_heading'); ?></h1>
            </div>
      </div>
</section>  
      <?php
 	// loop through the rows of data
    while ( have_rows('repeat_content_block') ) : the_row();
        // display a sub field value
        if( get_row_index() % 2 == 0 ){
        ?>
            <section class="additional-block">
                  <div class="container">
                        <div class="shell">
                              <div class="section-content row strategy-services">
                                    <div class="col-sm-6 col-md-6 col-md-push-6">
                                          <img class="img-responsive" src="<?=the_sub_field('image');?>">
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-md-pull-6">
                                          <h2 class="sub-heading"><?=the_sub_field('headings');?></h2>
                                          <h3 class=""><?=the_sub_field('sub_headings');?></h3>
                                          <p><?=the_sub_field('body_text');?></p>
                                    </div>
                              </div>
                        </div>
                  </div>
            </section>
<?php } else{ ?>
            <section class="additional-block">
                  <div class="container">
                        <div class="shell">
                              <div class="section-content row strategy-services">
                                    <div class="col-sm-6 col-md-6">
                                          <img class="img-responsive" src="<?=the_sub_field('image');?>">
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                          <h2 class="sub-heading"><?=the_sub_field('headings');?></h2>
                                          <h3 class=""><?=the_sub_field('sub_headings');?></h3>
                                          <p><?=the_sub_field('body_text');?></p>   
                                    </div>
                              </div>
                        </div>
                  </div>
            </section>
<?php } endwhile;endif; ?>
<?php
$pageID = get_the_ID();
$showmembers = get_field('show_team_members',$pageID);  
$heading = get_field('team_heading',$pageID);
if( $showmembers ):
?>
<section class="section___3 teammembers">
      <div class="container">
            <div class="shell">
                  <div class="section-content row">
                        <div class="col-xs-12 text-center">
                              <h1><?=$heading?></h1>
                        </div>
                  </div>
                  <?php
                  $post_objects = get_field('select_team_members',$pageID);
                  if( $post_objects ): ?>
                      <div class="row">
                      <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
                          <?php setup_postdata($post); ?>
                          <div class="col-xs-12 col-sm-6 col-md-4 text-center">
                              <div class="custom-box">
                                    <div class="team_avatar">  
                                          <?php if ( has_post_thumbnail() ) : ?>
                                                <?php the_post_thumbnail(); ?>
                                          <?php endif; ?>
                                    </div>
                                    <div class="team_info">  
                                          <h4><?php the_title(); ?></h4>
                                          <h5><?=get_field('designation')?></h5>
                                          <?=the_excerpt();?>
                                          <?php if(get_field('linkedin')){?>
                                          <a href="<?=get_field('linkedin')?>"><i class="fa fa-linkedin-square fa-2" aria-hidden="true"></i></a>
                                          <?php } ?>
                                          <?php if(get_field('facebook')){?>
                                          <a href="<?=get_field('facebook')?>"><i class="fa fa-facebook-square fa-2" aria-hidden="true"></i></a>
                                          <?php } ?>
                                    </div>
                              </div>
                      </div>
                      <?php endforeach; ?>
                      </div>
                      <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                  <?php endif;
                  ?>    
                  </div>
            </div>
      </div>
</section>
<section class="section___4">
      <div class="container">
            <div class="shell-fluid text-center">
                  <?php the_field('how_we_work_with_you_content'); ?>
            </div>
      </div>
</section>  
<section class="section___5">
      <div class="container">
            <div class="shell text-center">
                  <div class="col-xs-12">
                        <h1><?php the_field('services_that_compliment_our_strategy_solutions_content'); ?></h1>
                  </div>
                  <div class="col-xs-12">
                  <?php
                  $selectedservices = get_field('select_services');
                  
                  if( $selectedservices ): ?>
                      <div class="row">
                      <?php foreach( $selectedservices as $post): // variable must be called $post (IMPORTANT) ?>
                          <?php setup_postdata($post);?>
                          <div class="col-xs-12 col-sm-6 col-md-2">
                              <div class="text-center">  
                              <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail(); ?>
                              <?php endif; ?>
                              <h4><?php the_title(); ?></h4>
                              </div>
                      </div>
                      <?php endforeach; ?>
                      </div>
                      <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                  <?php endif;
                  ?>    
                  </div>
            </div>
      </div>      
</section>  
<?php endif;?>

<?php
$showtestimonial = get_field('show_testimonial',$pageID);  
if( $showtestimonial ):
?>
<section class="section___6 testimonials">
      <div class="container">
            <div class="shell">
                  <div class="section-content row">
                        <div class="col-xs-12">
                              <h1>Testimonials</h1>
                        </div>
                        <div class="col-xs-12">
                              <div class="featured owl-carousel" id="testimonial-slider">
                                    <?php
                                    $args = array(
                                          'post_type' => 'testimonial',
                                          'posts_per_page' => -1
                                    );
                                    $query = new WP_query ( $args );
                                    if ( $query->have_posts() ) {
                                          while ( $query->have_posts() ) : $query->the_post();
                                          $stick = get_field('stick_this_post_to_the_page',$query->post_id);  
                                          if( $stick ):
                                    ?>
                                    <div class="item" style="margin: 10px">
                                          <div class="testimonial_item text-center">
                                                <div class="author_avatar">
                                                      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                            <?php the_post_thumbnail(); ?>
                                                      </a>
                                                </div>
                                                <div class="testimonial_content">
                                                      <div class="author_writing">
                                                            <?=the_content()?>
                                                      </div>
                                                      <div class="author_info">
                                                            <h5><?=the_title();?></h5>
                                                            <span><?=get_field('testimonial_sub_heading');?></span>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>            
                                    <?php
                                          endif;
                                          endwhile;
                                          wp_reset_postdata();
                                    }
                                    ?>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</section>
<?php endif;?>

<?php }?>


    