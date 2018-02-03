<?php
$page = get_page_by_title( 'Home' );
$page_id = $page->ID;
?>
<section class="section___2">
      <div class="container">
            <div class="section-content row">
                  <div class="col-xs-12 keyservice_heading">
                        <?=get_field('key_service_heading',$page_id);?>
                  </div>
                  <?php
                    $args = array(
                            'post_type' => 'services',
                            'posts_per_page' => -1
                    );
                    $query = new WP_query ( $args );
                    if ( $query->have_posts() ) {
                            while ( $query->have_posts() ) : $query->the_post();
                    ?>
                              <div class="col-xs-12 col-sm-12 col-md-4 text-center">
                                    <div class="keyservices_container">
                                          <div class="row">
                                                <div class="col-xs-4 col-lg-12 text-center">
                                                    <?php
                                                    if ( has_post_thumbnail() ) {
                                                        the_post_thumbnail();
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-xs-8 col-lg-12 text-center keyservice_texts">
                                                    <a href="<?=the_permalink();?>">
                                                      <h2 class="sub-heading"><?=the_title();?></h2>
                                                    </a>
                                                      <p><?=the_excerpt();?></p> 
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        <?php endwhile; }?>
            </div>
      </div>      
</section>