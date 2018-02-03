<!--content page starts-->
<?php
if ( $post->post_content!=="" ):
?>
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
endif;
?> 
