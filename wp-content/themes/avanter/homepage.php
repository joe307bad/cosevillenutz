<?php
// Template Name: HomePage
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>
	
	<!-- The featured slider is called from the header.php located in the slider-progression.php file -->
	
	<!-- display homepage widgets -->
	<?php if ( is_active_sidebar( 'homepage-widgets' ) ) : ?>
		<?php dynamic_sidebar( 'homepage-widgets' ); ?>
	<?php endif; ?>
	
	<!-- homepage widgets end -->
	
	<!-- this code pull in the homepage content -->
	<?php while(have_posts()): the_post(); ?>
		<?php the_content(); ?>
		<div class="clearfix"></div>
	<?php endwhile; ?>
	
	<!-- Homepage Child Pages Start -->
	<?php
	$args = array(
		'post_type' => 'page',
		'numberposts' => -1,
		'post' => null,
		'post_parent' => $post->ID,
	    'order' => 'ASC',
	    'orderby' => 'menu_order'
	);
	$features = get_posts($args);
	$features_count = count($features);
	if($features):
		$count = 1;
		foreach($features as $post): setup_postdata($post);
			$image_id = get_post_thumbnail_id();
			$image_url = wp_get_attachment_image_src($image_id, 'large');
			if($count >= of_get_option('child_pages_column', '3')+1) { $count = 1; }
	?>
		<div class="home-child-boxes grid<?php echo of_get_option('child_pages_column', '3'); ?>column <?php if($count == of_get_option('child_pages_column', '3')): ?>lastcolumn<?php endif; ?>">
			<?php if(get_post_meta($post->ID, 'pageoptions_home-box-link', true)): ?><a href="<?php echo get_post_meta($post->ID, 'pageoptions_home-box-link', true) ?>"><?php endif; ?>
			<div class="home-child-boxes-container">
				<?php if($image_url[0]): ?><div class="home-image"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>"></div><?php endif; ?>
				<h6 class="home-child-title"><?php the_title(); ?></h6>
				<?php the_content(); ?>
			</div>
			<?php if(get_post_meta($post->ID, 'pageoptions_home-box-link', true)): ?></a><?php endif; ?>
		</div>
	<?php if($count == of_get_option('child_pages_column', '3')): ?><div class="clearfix"></div><?php endif; ?>
	<?php $count ++; endforeach; ?>
	<?php endif; ?>
	<div class="clearfix"></div>
	<!-- Homepage Child Pages End -->
	
	
	<!-- display homepage widgets -->
	<?php if ( is_active_sidebar( 'homepage-widgets-2' ) ) : ?>
		<?php dynamic_sidebar( 'homepage-widgets-2' ); ?>
	<?php endif; ?>
	
<?php get_footer(); ?>