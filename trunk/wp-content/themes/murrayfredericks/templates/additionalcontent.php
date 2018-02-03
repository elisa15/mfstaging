<!--content page start-->
<div id="body" role="document">
    <?php
    // check if the repeater field has rows of data
    if( have_rows('repeat_contents') ):
        // loop through the rows of data
        while ( have_rows('repeat_contents') ) : the_row(); $i++;
        // display a sub field value
        ?>
            <section id="<?php the_sub_field('id'); ?>" class="additional-content content-<?php echo $i; ?> <?php the_sub_field('classname'); ?> additional-block">
                <div class="container">
                    <div class="shell">
                        <div class="section-content row">
                            <div class="col-sm-12 col-md-12">
                                <?=the_sub_field('text');?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        endwhile;
    endif;
?>


<?php
// check if the repeater field has rows of data
if( have_rows('repeat_content_block') ):
 	// loop through the rows of data
    while ( have_rows('repeat_content_block') ) : the_row();
        // display a sub field value
        if( get_row_index() % 2 == 0 ){
        ?>
          <section class="additional-block">
          <div class="container">
            <div class="section-content row">
            <div class="col-sm-6 col-md-6 col-md-push-6">
                    <img class="img-responsive" src="<?=the_sub_field('featured_photo');?>">
              </div>
              <div class="col-sm-6 col-md-6 col-md-pull-6">
                    <h2 class="sub-heading">
                            <?php
                            if(!empty(the_sub_field('headings'))){
                            ?>
                                <?=the_sub_field('headings');?>
                            <?php
                                }
                            ?>
                    </h2> 
                    <h3 class="">
                    <?php
                        if(!empty(the_sub_field('sub_headings'))){
                    ?>
                        <?=the_sub_field('sub_headings');?>
                    <?php
                        }
                    ?>
                    </h3>

                    <p><?=the_sub_field('body_text');?></p>
                    <?php
                        if(!empty(the_sub_field('button_name')) && the_sub_field('button_name') != null){
                    ?>
                        <button type="button" class="btn custom-yellow-btn"><?=the_sub_field('button_name');?></button>  
                    <?php
                         }
                    ?>     
              </div>
              
            </div>
            </div>
          </section>
<?php
        }
        else{
          ?>
          
          <section class="additional-block">
          <div class="container">
            <div class="section-content row">
              <div class="col-sm-6 col-md-6">
                    <img class="img-responsive" src="<?=the_sub_field('featured_photo');?>">
              </div>
              <div class="col-sm-6 col-md-6">
                    <h2 class="sub-heading">
                            <?php
                            if(!empty(the_sub_field('headings'))){
                            ?>
                                <?=the_sub_field('headings');?>
                            <?php
                                }
                            ?>
                    </h2>    
                    <h3 class="">  
                    <?php
                        if(!empty(the_sub_field('sub_headings'))){
                    ?>
                        <?=the_sub_field('sub_headings');?>
                    <?php
                        }
                    ?>
                    </h3>
                    <p><?=the_sub_field('body_text');?></p>
                    <?php
                        if(!empty(the_sub_field('button_name')) && the_sub_field('button_name') != null){
                    ?>
                        <button type="button" class="btn custom-yellow-btn"><?=the_sub_field('button_name');?></button>  
                    <?php
                         }
                    ?>  
              </div>
            </div>
            </div>
          </section>
          
          <?php
        }
    endwhile;
endif;
?>
