<?php
/**
 * The Template for displaying all single posts.
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>



<div id="page-title">
	<div class="width-container">
		<?php $page_for_posts = get_option('page_for_posts'); ?>
		<h1 id="page-title-heading"><?php echo get_the_title($page_for_posts); ?></h1>
	</div>
</div>

<div id="main">
	<div class="width-container">
		<?php if(of_get_option('blog_sidebar_single', '1')): ?><div id="content-container"><?php endif; ?>
			
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>
			
		<div class="clearfix"></div>
	<?php if(of_get_option('blog_sidebar_single', '1')): ?></div><!-- close #content-container --><?php endif; ?>

<?php if(of_get_option('blog_sidebar_single', '1')): ?><?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>
