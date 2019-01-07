<?php
/**
 * @package progression
 */
?>
<div class="portfolio-index">
	<?php if( has_post_format( 'gallery' ) ): ?>
		<div class="flexslider gallery-anchor">
	      	<ul class="slides">
				<?php
				$args = array(
				    'post_type' => 'attachment',
				    'numberposts' => '-1',
				    'post_status' => null,
				    'post_parent' => $post->ID,
					'orderby' => 'menu_order',
					'order' => 'ASC'
				);
				$attachments = get_posts($args);
				?>
				<?php 
				if($attachments):
				    foreach($attachments as $attachment):
				?>
				<?php $thumbnail = wp_get_attachment_image_src($attachment->ID, 'progression-portfolio-thumb'); ?>
				<?php $image = wp_get_attachment_image_src($attachment->ID, 'large'); ?>
				<li><a href="<?php echo $image[0]; ?>" rel="prettyPhoto[portfolio-gallery]"><img src="<?php echo $thumbnail[0]; ?>" alt="gallery-image" /></a></li>
				<?php endforeach; endif; ?>
			</ul>
		</div>
	<?php else: ?>
	<?php if(has_post_thumbnail()): ?>
		<?php if(get_post_meta($post->ID, 'portfoliooptions_externallink', true)): ?>
			<a href="<?php echo get_post_meta($post->ID, 'portfoliooptions_externallink', true) ?>">
		<?php else: ?>
			
		<?php if(get_post_meta($post->ID, 'portfoliooptions_lightbox', true)): ?>
			<a href="<?php echo get_post_meta($post->ID, 'portfoliooptions_lightbox', true) ?>" rel="prettyPhoto">
		<?php else: ?>
		<a href="<?php the_permalink(); ?>">
		<?php endif; ?>
		<?php endif; ?>
			<?php the_post_thumbnail('progression-portfolio-thumb'); ?>
		</a>
	<?php else: ?>
		<?php if(get_post_meta($post->ID, 'portfoliooptions_videoembed', true)): ?>
			<!-- iFrame Video Here --><div class="video-portfolio"><?php echo get_post_meta($post->ID, 'portfoliooptions_videoembed', true) ?></div>
	<?php endif; ?>
	<?php endif; ?>
	<?php endif; ?>
		<?php if(get_post_meta($post->ID, 'portfoliooptions_externallink', true)): ?>
			<a href="<?php echo get_post_meta($post->ID, 'portfoliooptions_externallink', true) ?>" class="progression-button progression-grey">
		<?php else: ?>
		<a href="<?php the_permalink(); ?>" class="progression-button progression-grey">
		<?php endif; ?>
			<?php the_title(); ?>
		</a>
</div><!-- close .portfolio-index -->
<div class="clearfix"></div>