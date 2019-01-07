<?php
/**
 * The template used for displaying featured slider called from the header.php
 *
 * @package progression
 * @since progression 1.0
 */
?>
<div id="page-title">
	
	<?php while ( have_posts() ) : the_post(); ?>
	<div class="width-container">
		<h2><?php the_title(); ?></h2>
	</div>
	<?php endwhile; // end of the loop. ?>


<?php
$portfolio_type = get_the_term_list( $post->ID, 'portfolio_type' );
$portfolioloop = new WP_Query(array(
    'paged'          => get_query_var('paged'),
    'post_type'      => 'portfolio',
    'posts_per_page' => 99,
    'tax_query'      => array(
        // Note: tax_query expects an array of arrays!
        array(
            'taxonomy' => 'portfolio_type', // my guess
            'field'    => 'name',
            'terms'    => $portfolio_type
        ),
    ),
));
?>
	<div class="flexslider" id="homepage-slider">
	<ul class="slides">
	<?php while ( $portfolioloop->have_posts() ) : $portfolioloop->the_post(); ?>
		
		
		<?php if(get_post_meta($post->ID, 'portfoliooptions_videoembed', true)): ?>
			<li class="example-class <?php if(get_post_meta($post->ID, 'slideroptions_slider_secondary', true)): ?> simple-captions<?php else: ?> complex-captions<?php endif; ?>">	
				
				<?php if(get_post_meta($post->ID, 'slideroptions_slider_caption', true)): ?>					
					<?php else: ?>
						<div class="flex-caption">
							<div class="width-container">
							<div class="slider-container<?php if(get_post_meta($post->ID, 'slideroptions_slider_right', true)): ?> slider-box-right<?php endif; ?>">
								<div class="slider-box">
									<h5><?php the_title(); ?></h5>
									<?php the_content(); ?>
								</div>
							</div><!-- close .slider-container -->
							</div><!-- close .width-container -->
						</div><!-- close .flex-caption -->
				<?php endif; ?>
				
			<!-- iFrame Video Here --><div class="video-slide-pro"><?php echo get_post_meta($post->ID, 'portfoliooptions_videoembed', true) ?></div>
		</li>
		<?php else: ?>
		
		<?php if(has_post_thumbnail()): ?>
		<li class="example-class <?php if(get_post_meta($post->ID, 'slideroptions_slider_secondary', true)): ?> simple-captions<?php else: ?> complex-captions<?php endif; ?>">	
			
			<?php if(get_post_meta($post->ID, 'slideroptions_slider_caption', true)): ?>					
				<?php else: ?>
					<div class="flex-caption">
						<div class="width-container">
						<div class="slider-container<?php if(get_post_meta($post->ID, 'slideroptions_slider_right', true)): ?> slider-box-right<?php endif; ?>">
							<div class="slider-box">
								<h5><?php the_title(); ?></h5>
								<?php the_content(); ?>
							</div>
						</div><!-- close .slider-container -->
						</div><!-- close .width-container -->
					</div><!-- close .flex-caption -->
			<?php endif; ?>
			<?php if(get_post_meta($post->ID, 'portfoliooptions_externallink', true)): ?>
				<a href="<?php echo get_post_meta($post->ID, 'portfoliooptions_externallink', true) ?>">
			<?php endif; ?>
			<?php the_post_thumbnail('progression-slider'); ?>
			<?php if(get_post_meta($post->ID, 'portfoliooptions_externallink', true)): ?>
			</a>
			<?php endif; ?>
		</li>
		<?php endif; ?>
		
		<?php endif; ?>
	<?php endwhile; // end of the loop. ?>
	</ul>
</div><!-- close .flexslider -->
</div><!-- #page-title -->
<div class="clearfix"></div>

<div id="main">
	<div class="width-container">