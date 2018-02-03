<?php if (is_category()) { ?>
	<h1 class="page-title"><?php single_term_title('', true); ?></h1>
<?php }else{ ?>
	<?php $categories = get_categories(); ?>
	<ul class="nav nav-pills category-list">
	<?php foreach ($categories as $category) { ?>
		<li role="presentation"><a href="<?php echo get_bloginfo( 'url' ) . '/category/' . $category->category_nicename; ?>"><?php echo $category->cat_name; ?></a></li>
	<?php } ?>
	</ul>
<?php } ?>
<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>
<div class="row blog-list">
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
<?php endwhile; ?>
</div>
<?php the_posts_navigation(); ?>
