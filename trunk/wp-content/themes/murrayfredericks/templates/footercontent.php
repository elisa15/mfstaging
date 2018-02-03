<?php
$page = get_page_by_title( 'Footer' );
$page_id = $page->ID;
?>
<div class="container">
    <div class="section-content row nopadding">
        <div class="col-md-5 col-sm-12  col-xs-12">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <h3><span>HQ</span></h3>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div><?=the_field('brisbane', $page_id);?></div>
                        <div><?=the_field('manila', $page_id);?></div>
                    </div>
                    <div class="col-sm-12 col-md-5">
                        <div><p>P <?=the_field('phone', $page_id);?></p></div>
                        <div><p>E <?=the_field('email', $page_id);?></p></div>
                    </div>
                </div>
        </div>
        <div class="col-md-7 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-xs-push-0 col-md-push-4">
                        <h3><span>Services</span></h3>
                        <div>
                            <?php if( have_rows('services_list', $page_id) ): ?>
                                <ul class="menu-services">
                                    <?php while ( have_rows('services_list', $page_id) ) : the_row(); ?>
                                        <li><?=the_sub_field('service_title', $page_id);?></li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-xs-push-0 col-sm-push-0 col-md-push-4 copyright">
                        <h3><i class="fa fa-linkedin" aria-hidden="true"></i> <i class="fa fa-facebook" aria-hidden="true"></i></h3>
                        <div><?=the_field('copyright', $page_id);?></div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-xs-pull-0 col-md-pull-8">
                        <div class="text-center"><img src="<?=the_field('company_logo', $page_id);?>"></div>
                    </div>
                </div>
        </div>
    </div>
</div>    
