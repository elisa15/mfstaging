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
                              <div class="col-sm-6 col-md-6">
                                    <img class="img-responsive" src="<?=the_sub_field('image');?>">
                              </div>
                              <div class="col-sm-6 col-md-6">
                                    <h2 class="sub-heading"><?=the_sub_field('heading');?></h2>
                                    <h3 class=""><?=the_sub_field('sub_heading');?></h3>
                                    <p><?=the_sub_field('content_body');?></p>
                                    <?php
                                    if(!empty(the_sub_field('button_name')) || the_sub_field('button_name') != null){
                                    ?>
                                    <button type="button" class="btn custom-yellow-btn"><?=the_sub_field('button_name');?></button>  
                                    <?php } ?>     
                              </div>
                        </div>
                  </div>
            </section>
<?php } else{ ?>
    <section class="additional-block">
                  <div class="container">
                        <div class="section-content row">
                              <div class="col-sm-6 col-md-6 col-md-push-6">
                                    <img class="img-responsive" src="<?=the_sub_field('image');?>">
                              </div>
                              <div class="col-sm-6 col-md-6 col-md-pull-6">
                                    <h2 class="sub-heading"><?=the_sub_field('heading');?></h2>
                                    <h3 class=""><?=the_sub_field('sub_heading');?></h3>
                                    <p><?=the_sub_field('content_body');?></p>
                                    <?php
                                    if(!empty(the_sub_field('button_name')) || the_sub_field('button_name') != null){
                                    ?>
                                    <button type="button" class="btn custom-yellow-btn"><?=the_sub_field('button_name');?></button>  
                                    <?php }?>      
                              </div>
                        </div>
                  </div>
            </section>
            
<?php } endwhile;endif; ?>