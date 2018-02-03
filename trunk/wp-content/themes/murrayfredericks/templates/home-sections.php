<section class="section___1 intro" id="intro">
      <div class="container">
            <div class="shell">
                  <div class="section-content row text-center">
                        <div class="col-sm-12 we-can-transform-you">
                              <?=the_content()?>
                        </div>
                  </div>
            </div>
      </div>
</section>      
<?php
// check if the repeater field has rows of data
if( have_rows('repeat_content') ):
 	// loop through the rows of data
    while ( have_rows('repeat_content') ) : the_row();
        // display a sub field value
        if( get_row_index() % 2 == 0 ){
        ?>
            <section class="additional-block">
                  <div class="container">
                        <div class="section-content row">
                              <div class="col-sm-6 col-md-6 col-md-push-6">
                                    <img class="img-responsive" src="<?=the_sub_field('image');?>">
                              </div>
                              <div class="col-sm-6 col-md-6 col-md-pull-6">
                                    <div class="shell pull-right">
                                          <h2 class="sub-heading"><?=the_sub_field('heading');?></h2>
                                          <h3 class=""><?=the_sub_field('sub_heading');?></h3>
                                          <p><?=the_sub_field('content_body');?></p>
                                          <button type="button" class="btn custom-yellow-btn"><?=the_sub_field('button_name');?></button>    
                                    </div>
                              </div>
                        </div>
                  </div>
            </section>
<?php } else{ ?>
            <section class="additional-block">
                  <div class="container">
                        <div class="section-content row">
                              <div class="col-sm-6 col-md-6">
                                    <img class="img-responsive" src="<?=the_sub_field('image');?>">
                              </div>
                              <div class="col-sm-6 col-md-6">
                                    <div class="shell pull-left">
                                          <h2 class="sub-heading"><?=the_sub_field('heading');?></h2>
                                          <h3 class=""><?=the_sub_field('sub_heading');?></h3>
                                          <p><?=the_sub_field('content_body');?></p>
                                          <button type="button" class="btn custom-yellow-btn"><?=the_sub_field('button_name');?></button> 
                                    </div>
                              </div>
                        </div>
                  </div>
            </section>
<?php } endwhile;endif; ?>

<?php get_template_part('templates/keyservices', 'page'); ?>

<section class="section___3">
      <div class="shell-fluid">
            <div class="section-content row nopadding">
                  <div class="col-sm-6 col-md-6 pull-xs-0 nopadding">
                        <img class="img-responsive" src="<?=the_field('featured_image',$page_id);?>">
                  </div>
                  <div class="col-sm-6 col-md-6 push-xs-0 nopadding">
                        <div class="shell">
                              <h2 class="sub-heading"><?=the_field('content_title',$page_id);?></h2>
                              <p><?=the_field('content_description',$page_id);?></p>
                              <button type="button" class="btn custom-yellow-btn">Learn More</button>  
                        </div>  
                  </div>
            </div>
      </div>
</section>
<section class="section___4">
      <div class="container">
            <div class="section-content row">
                  <div class="col-xs-12">
                        <div class="leading_our_clients"><?=the_field('section_headings',$page_id);?></div>
                        <div class="featured owl-carousel" id="featured-slider">
                              <?php
                                    $args = array(
                                          'post_type' => 'work',
                                          'posts_per_page' => -1
                                    );
                                    $query = new WP_query ( $args );
                                    if ( $query->have_posts() ) {
                                          while ( $query->have_posts() ) : $query->the_post();
                                          $sticky = get_field('stick_this_post_to_the_front_page');  
                                          if( $sticky ):
                              ?>
                              <div class="item" style="margin: 10px">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                          <div>
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                      <?php the_post_thumbnail(); ?>
                                                </a>
                                          </div>
                                    <?php endif; ?>
                                    <div class="item_details_main_container">
                                          <div class="list_of_categories">
                                                <?php
                                                $args = array(
                                                      'hide_empty' => false
                                                );
                                                $taxonomy = 'work_categories';
                                                $terms = get_terms($taxonomy, $args); // Get all terms of a taxonomy

                                                if ( $terms && !is_wp_error( $terms ) ) :
                                                ?>
                                                      <ul class="work_categories">
                                                            <?php foreach ( $terms as $term ) { ?>
                                                                  <li><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a></li>
                                                            <?php } ?>
                                                      </ul>
                                                <?php endif;?>
                                          </div>
                                          <div class="work_details">
                                                <h3><?=the_title()?></h3>
                                                <div><?=the_excerpt()?></div>
                                                <button type="button" class="btn custom-yellow-btn">View Case Study</button>
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
</section>

<section class="section___5">
      <div class="container">
            <div class="section-content row">
                  <div class="logos">
                  <?php
                        // check if the repeater field has rows of data
                        if( have_rows('logo_repeat') ):
                              // loop through the rows of data
                        while ( have_rows('logo_repeat') ) : the_row();
                  ?>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                              <img src="<?=the_sub_field('logo');?>" class="aligncenter">
                        </div>
                        <?php
                        endwhile;
                        else :
                              echo 'no rows found';
                        endif;
                        ?>
                  </div>
            </div>
      </div>
</section>

<section class="section___6">
      <div class="container">
            <div class="section-content row">
                  <div class="col-sm-12 col-md-12">
                        <div class="shell"><?=the_field('contact_section');?></div>
                  </div>
            </div>
      </div>
</section>