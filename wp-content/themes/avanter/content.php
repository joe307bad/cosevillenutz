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
		<?php if(has_post_thumbnail()): ?>
		<div class="blog-featured">
			<?php if(get_post_meta($post->ID, 'videoembed_externallink', true)): ?><a href="<?php echo get_post_meta($post->ID, 'videoembed_externallink', true) ?>"><?php else: ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php endif; ?><?php the_post_thumbnail('progression-blog'); ?></a>
		</div><!-- close .blog-featured -->
		<?php else: ?>
		<?php if(get_post_meta($post->ID, 'videoembed_videoembed', true)): ?>
			<div class="blog-featured blog-video-sensica">
				<?php echo apply_filters('the_content', get_post_meta($post->ID, 'videoembed_videoembed', true)); ?>
			</div>
		<?php endif; ?>
		<?php endif; ?>
		<?php endif; ?>
		
		<div class="grid2column">
			<h4 class="entry-title"><?php if(get_post_meta($post->ID, 'videoembed_externallink', true)): ?><a href="<?php echo get_post_meta($post->ID, 'videoembed_externallink', true) ?>"><?php else: ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php endif; ?><?php the_title(); ?></a></h4>
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
		
		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="index-excerpt search-excerpt">
			<?php the_excerpt(); ?>
		</div><!-- .index-excerpt -->
		<?php else : ?>
		<div class="index-excerpt">
			<?php the_content( __( 'Continue reading', 'progression' ) ); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'progression' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .index-excerpt -->
		<?php endif; ?>
		<div class="clearfix"></div>
</article><!-- #post-## -->
<hr>