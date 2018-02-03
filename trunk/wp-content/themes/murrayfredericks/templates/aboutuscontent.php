<?php
$aboutpage = get_page_by_title( 'About us' );
$aboutpage_id = $aboutpage->ID;
$page = get_page_by_title( 'Our Story' );
$page_id = $page->ID;
$post_content = get_post($aboutpage_id);
$content = $post_content->post_content;
?>
<!--section class="intro_____section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?=wpautop( $content, true );?>
            </div>
        </div>
    </div>
</section-->
<section class="timeline_____section">
    <div class="container">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
                <ul class="timeline timeline-centered">
                    <?php
                    // check if the repeater field has rows of data
                    if( have_rows('timeline_year',$page_id) ):
                        // loop through the rows of data
                        while ( have_rows('timeline_year',$page_id) ) : the_row();
                    ?>
                        <li class="timeline-item period">
                            <div class="timeline-info"></div>
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h2 class="timeline-title"><?=the_sub_field('year',$page_id);?></h2>
                            </div>
                        </li>
                        <?php
                        // check if the repeater field has rows of data
                        if( have_rows('timeline_month',$page_id) ):
                            // loop through the rows of data
                            while ( have_rows('timeline_month',$page_id) ) : the_row();
                        ?>
                            <li class="timeline-item">
                                <div class="timeline-info">
                                    <span><?=the_sub_field('month',$page_id);?></span>
                                </div>
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <div class="shadowbox">
                                        <p><?=the_sub_field('description',$page_id);?></p>
                                        <?php if( get_sub_field('featured_photo',$page_id) ): ?>
                                            <img src="<?php the_sub_field('featured_photo',$page_id); ?>" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </li>
                        <?php
                            endwhile;
                        endif;
                        ?>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="additional-block">
    <div class="section-content row offset-section row-eq-height">
    <div class="col-xs-12 col-md-8 col-md-offset-1 col-xs-offset-0  nopadd">
            <div class="limit">
                  <img src="<?=get_field('offset_featured_photo',$aboutpage_id);?>" />
                   <?=get_field('offset_content_description',$aboutpage_id);?>
            </div>
            
      </div>
    <div class="col-xs-12 col-md-4 lightcolumn nopadd">
            <div class="shell">
                  <h1><?=get_field('offset_content_description',$aboutpage_id);?></h1>
                   
            </div>
      </div>
    </div>
</section>
<section class="team_____section">
      <div class="container">
        <?php
        echo do_shortcode('[team]');
        ?>
      </div>
</section>   
<section class="whychoosefollow_____section">
      <div class="container text-center">
            <div class="row">
                <div class="col-xs-12"><h1><?=get_field('section_heading', $aboutpage_id);?></h1></div>
            </div>
            <?php if( have_rows('why_choose_follow', $aboutpage_id) ): ?>
                <div class="row">
                    <?php while ( have_rows('why_choose_follow', $aboutpage_id) ) : the_row(); ?>
                        <div class="col-md-4">
                            <div><img src="<?=the_sub_field('icon', $aboutpage_id);?>"></div>
                            <div><?=the_sub_field('title', $aboutpage_id);?></div>
                            <div><?=the_sub_field('description', $aboutpage_id);?></div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
      </div>
</section>   

<section class="ouroffices_____section">
        <div class="section-content row offset-section row-eq-height">
            <div class="col-xs-12 col-md-3 col-md-offset-1 col-xs-offset-0 nopadd text-right">
                <h1 class="text-center">Our Offices</h1>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                            <div class="location___name"><i class="fa fa-map-marker" aria-hidden="true"></i> Follow: Brisbane</div>
                            <div class="office___label">Head Office</div>
                            <?php 
                                $brisbane = get_field('brisbane');
                                if($brisbane){
                            ?>
                            <div class="office___address"><?=$brisbane['brisbane_head_office_address'];?></div>
                            <div class="office___viewmap">View on map</div>
                            <div class="office___phone"><?=$brisbane['phone'];?></div>
                            <div class="office___email"><?=$brisbane['email'];?></div>
                            <?php }?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                            <div class="location___name"><i class="fa fa-map-marker" aria-hidden="true"></i> Follow: Manila</div>
                            <div class="office___label">Production Office</div>
                            <?php 
                                $manila = get_field('manila');
                                if($manila){
                            ?>
                            <div class="office___address"><?=$manila['manila_head_office_address'];?></div>
                            <div class="office___viewmap">View on map</div>
                            <div class="office___phone"><?=$manila['manila_phone'];?></div>
                            <div class="office___email"><?=$manila['manila_email'];?></div>
                            <?php }?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-xs-12 col-md-8 nopadd">
                 <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel">
                        <div class="google-maps"><?=$brisbane['brisbane_google_map'];?></div>
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel">
                        <div class="google-maps"><?=$manila['manila_google_map'];?></div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!--section class="getintouch">
      <div class="container">
            <div class="section-content row">
                  <div class="col-md-6 col-xs-12">
                      <div class="shell">
                       test
                       </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                        test
                  </div>
            </div>
      </div>
</section-->

