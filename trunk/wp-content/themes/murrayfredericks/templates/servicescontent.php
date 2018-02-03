<?php
$page = get_page_by_title( 'Services' );
$page_id = $page->ID;
?>
<?php get_template_part('templates/keyservices', 'page'); ?>
<?php
// check if the repeater field has rows of data
if( have_rows('repeat_content_block',$page_id) ):
 	// loop through the rows of data
    while ( have_rows('repeat_content_block',$page_id) ) : the_row();
        ?>
            <section class="additional-block">
                  <div class="container">
                        <div class="section-content row">
                              <div class="col-sm-6 col-md-6 col-md-push-6">
                                    <img class="img-responsive" src="<?=the_sub_field('featured_photo'),$page_id;?>">
                              </div>
                              <div class="col-sm-6 col-md-6 col-md-pull-6">
                                    <h2 class="sub-heading"><?=the_sub_field('headings',$page_id);?></h2>
                                    <h3 class=""><?=the_sub_field('sub_headings',$page_id);?></h3>
                                    <p><?=the_sub_field('body_text',$page_id);?></p>
                                    <?php
                                    if(!empty(the_sub_field('button_name',$page_id)) || the_sub_field('button_name',$page_id) != null){
                                    ?>
                                    <button type="button" class="btn custom-yellow-btn"><?=the_sub_field('button_name');?></button>  
                                    <?php }?>      
                              </div>
                        </div>
                  </div>
            </section>
<?php endwhile;endif; ?>

<section class="additional-block">
    <div class="section-content row offset-section row-eq-height">
      <div class="col-xs-12 col-md-5 col-md-offset-2 col-xs-offset-0 darkcolumn nopadd">
            <div class="shell">
                  <h1><?=get_field('offset_heading',$page_id);?></h1>
                  <p><?=get_field('offset_content_description',$page_id);?></p>
                  <button type="button" class="btn custom-yellow-btn"><?=get_field('offset_button_title',$page_id);?></button> 
            </div>
      </div>
      <div class="col-xs-12 col-md-6 nopadd">
            <div class="limit">
                  <img src="<?=get_field('offset_featured_photo',$page_id);?>" />
            </div>
            
      </div>
    </div>
</section>


<section class="section___3">
      <div class="container">
            <div class="shell">
                  <div class="section-content row">
                        <div class="col-sm-12 col-md-12">
                              <div class="shell"><?=the_field('industry_expertise_intro',$page_id);?></div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                        <?php
                        $post_objects = get_field('industry_expertise_posts',$page_id);
                        
                        if( $post_objects ): ?>
                        <div class="row">
                        <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
                              <?php setup_postdata($post); ?>
                              <div class="col-xs-12 col-sm-6 col-md-3">
                                    <div class="custombox text-center">  
                                    <?php if ( has_post_thumbnail() ) : ?>
                                          <?php the_post_thumbnail(); ?>
                                    <?php endif; ?>
                                    <h4><?php the_title(); ?></h4>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                          More about this
                                    </a>
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
      </div>
</section>
<?php
$showthis = get_field('show_testimonial_section',$page_id);  
if( $showthis ):
?>
<section class="section___4 testimonials">
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
