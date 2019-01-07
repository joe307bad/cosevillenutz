<?php get_header(); ?>

<?php
while(have_posts()): the_post();
?>
<div id="page-title">
	<div class="width-container">
		<h1 id="page-title-heading"><?php the_title(); ?></h1>
	</div>
</div>

<div id="main">
	<div class="width-container">
		<?php if(of_get_option('room_sidebar_single', '1')): ?><div id="content-container"><?php endif; ?>
		
		<div class="pagination-portfolio">
			<div class="grid2column">
				<?php 
				if (function_exists('next_post_link_plus')) {
				next_post_link_plus( array(
					'loop' => false,
					'tooltip' => 'Previous post',
					'in_same_tax' => 'portfolio_type',
					'format' => '%link'
				) );
				}
				?>
				<div class="genericon genericon-draggable"></div>
			</div>
			<div class="grid2column lastcolumn">
				<?php 
				if (function_exists('previous_post_link_plus')) {
				previous_post_link_plus( array(
					'loop' => false,
					'tooltip' => 'Previous post',
					'in_same_tax' => 'portfolio_type',
					'format' => '%link'
				) );
				}
				?>
			</div>
			<div class="clearfix"></div>
		</div><!-- close .pagination-portfolio -->

			<?php if(get_post_meta($post->ID, 'portfoliooptions_videoembed', true)): ?>
				<!-- iFrame Video Here --><div class="blog-featured"><?php echo get_post_meta($post->ID, 'portfoliooptions_videoembed', true) ?></div>
			<?php else: ?>
			<?php if( has_post_format( 'gallery' ) ): ?>
				<div class="blog-featured">
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
						<?php $thumbnail = wp_get_attachment_image_src($attachment->ID, 'progression-portfolio-single'); ?>
						<?php $image = wp_get_attachment_image_src($attachment->ID, 'large'); ?>
						<li><a href="<?php echo $image[0]; ?>" rel="prettyPhoto[portfolio-gallery]"><img src="<?php echo $thumbnail[0]; ?>" alt="gallery-image" /></a></li>
						<?php endforeach; endif; ?>
					</ul>
				</div>
				</div>
			<?php else: ?>
			<?php if(has_post_thumbnail()): ?>
			<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); ?>
			<div class="blog-featured">
				<?php if(get_post_meta($post->ID, 'portfoliooptions_lightbox', true)): ?>
					<a href="<?php echo get_post_meta($post->ID, 'portfoliooptions_lightbox', true) ?>" rel="prettyPhoto">
				<?php else: ?>
				<a href="<?php echo $image[0]; ?>" rel="prettyPhoto">
				<?php endif; ?>
					<?php the_post_thumbnail('progression-portfolio-single'); ?>
				</a>
			</div>
			<?php endif; ?>
			<?php endif; ?>
			<?php endif; ?>
			<?php the_content(); ?>
<?php endwhile; ?>
			<?php if(of_get_option('portfolio_comments_default', '0')): ?><?php comments_template( '', true ); ?><?php endif; ?>
			<div class="clearfix"></div>

<?php if(of_get_option('room_sidebar_single', '1')): ?></div><!-- close #content-container --><?php endif; ?>
	<?php if(of_get_option('room_sidebar_single', '1')): ?><?php get_sidebar(); ?><?php endif; ?>

<?php get_footer(); ?>