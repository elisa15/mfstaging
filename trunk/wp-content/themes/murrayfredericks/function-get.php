<?php

// check if the repeater field has rows of data
if( have_rows('type_strings') ):

 	// loop through the rows of data
    while ( have_rows('type_strings') ) : the_row();

        // display a sub field value
        echo the_sub_field('type_text');

    endwhile;

else :

    // no rows found

endif;

?>