<?php
$contactpage = get_page_by_title( 'Contact' );
$contact_id = $contactpage->ID;
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
                                <!-- Button trigger modal -->
                                <?php
                                if(get_sub_field('button_name',$contact_id)!=null || !empty(get_sub_field('button_name',$contact_id)))
                                {
                                ?>
                                <div class="text-center">
                                <a href="#" class="btn btn-default" data-toggle="modal" data-target="#myModal"><?=the_field('button_name',$contact_id);?></a>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        endwhile;
    endif;
?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <?=the_field('embed_google_map_code',$contact_id);?>
        </div>
    </div>
  </div>
</div>
    