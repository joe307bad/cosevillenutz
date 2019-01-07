<?php
/**
 * @package progression
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
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
				<?php $thumbnail = wp_get_attachment_image_src($attachment->ID, 'progression-blog'); ?>
				<?php $image = wp_get_attachment_image_src($attachment->ID, 'large'); ?>
				<li><a href="<?php echo $image[0]; ?>" rel="prettyPhoto[gallery]"><img src="<?php echo $thumbnail[0]; ?>" alt="gallery-image" /></a></li>
				<?php endforeach; endif; ?>
			</ul>
		</div>
		</div>
	<?php else: ?>
	<?php if(get_post_meta($post->ID, 'videoembed_videoembed', true)): ?>
		<div class="blog-featured blog-video-sensica">
			<?php echo apply_filters('the_content', get_post_meta($post->ID, 'videoembed_videoembed', true)); ?>
		</div>
	<?php else: ?>
	<?php if(has_post_thumbnail()): ?>
	<div class="blog-featured">
		<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); ?>
		<a href="<?php echo $image[0]; ?>" rel="prettyPhoto"><?php the_post_thumbnail('progression-blog'); ?></a>
	</div><!-- close .blog-featured -->
	<?php endif; ?>
	<?php endif; ?>
	<?php endif; ?>
	
	<div class="grid2column">
		<h4 class="entry-title"><?php the_title(); ?></h4>
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="avanter-date-meta">
			<?php progression_posted_on(); ?>
		</div><!-- .post-meta -->
		<?php endif; ?>
	</div>
	
	<?php if ( 'post' == get_post_type() ) : ?>
	<div class="grid2column lastcolumn">
		<div class="avanter-post-meta">
			<div class="avanter-author-link"><span class="genericon genericon-user"></span><?php the_author_posts_link(); ?></div>
			<div class="avanter-category"><span class="genericon genericon-category"></span><?php the_category(', '); ?></div>
			<div class="avanter-comment"><span class="genericon genericon-chat"></span><?php comments_popup_link( '' . __( '0', 'progression' ) . '', _x( '1', 'comments number', 'progression' ), _x( '%', 'comments number', 'progression' ) ); ?></div>
		</div><!-- .post-meta -->
	</div>
	<?php endif; ?>
	<div class="clearfix"></div>
	
	
	<div class="index-excerpt">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'progression' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<div class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'progression' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'progression' ) );

			if ( ! progression_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s.', 'progression' );
				} else {
					$meta_text = __( '', 'progression' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s.', 'progression' );
				} else {
					$meta_text = __( 'This entry was posted in %1$s.', 'progression' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink(),
				the_title_attribute( 'echo=0' )
			);
		?>

	</div><!-- .entry-meta -->
</article><!-- #post-## -->
<hr>