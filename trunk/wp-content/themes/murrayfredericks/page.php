<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  
  <?php if(is_front_page()) {?>
      <?php get_template_part('templates/home-sections', 'page'); ?>
<?php }
else{ ?>
	<?php get_template_part('templates/content', 'page'); ?>
	<?php if(is_page('Services') || is_page('Work') || is_page('About us') || is_page('Approach')){?>
		<?php get_template_part('templates/additionalcontent', 'page'); ?>
	<?php } ?>

	<?php if(is_page('Services')){?>
		<?php get_template_part('templates/servicescontent', 'page'); ?>
	<?php } ?>
	<?php if(is_page('Work')){?>
		<?php get_template_part('templates/workcontent', 'page'); ?>
	<?php } ?>
	<?php if(is_page('About us')){?>
			<?php get_template_part('templates/aboutuscontent', 'page'); ?>
	<?php } ?>
	<?php if(is_page('Approach')){?>
			<?php get_template_part('templates/approachcontent', 'page'); ?>
	<?php } ?>
	<?php if(is_page('Contact')){?>
		<?php get_template_part('templates/contactcontent', 'page'); ?>
	<?php } ?>	
<?php }?>
  
<?php endwhile; ?>
