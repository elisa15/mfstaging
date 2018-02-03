<article class="col-md-4">
  	<div class="wrap">
  		<?php if( has_post_thumbnail() ) { ?>
  		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' ); ?>
  		<div class="featured"><a href="<?php the_permalink(); ?>" style="background: url('<?php echo $image[0]; ?>') 50% 50% no-repeat; background-size: cover;"><?php the_post_thumbnail( 'medium' ); ?></a></div>
  		<?php } ?>
		<header>
			<?php 
			$cats = array();
			foreach(wp_get_post_categories(get_the_ID()) as $c) {
				$cat = get_category($c);
				array_push($cats,'<a href="'. get_bloginfo( 'url' ) . '/category/' . $cat->slug . '/">'.$cat->name.'</a>');
			}
			if(sizeOf($cats)>0) {
				$post_categories = implode(', ',$cats);
			}
			?>
			<?php if(sizeOf($cats)>0) { ?>
			<p class="meta-categories"><?php echo $post_categories; ?></span></p>
			<?php } ?>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php get_template_part('templates/entry-meta'); ?>
		</header>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>
