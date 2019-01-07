<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>
	<div id="page-title">
		<div class="width-container">
			<?php $page_for_posts = get_option('page_for_posts'); ?>
			<?php if( get_option( 'page_for_posts' ) ) : $cover_page = get_page( get_option( 'page_for_posts' ) ); ?>
				<h1 id="page-title-heading"><?php echo get_the_title($page_for_posts); ?></h1>
			<?php else : ?>
				<h1 id="page-title-heading"><?php esc_html_e( 'News', 'progression' ); ?></h1>
			<?php endif; ?>
		</div>
	</div>
	
	<div id="main">
		<div class="width-container">
			<?php if(of_get_option('blog_sidebar', '1')): ?><div id="content-container"><?php endif; ?>
				
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>
				<?php endwhile; ?>
				
				<div class="clearfix"></div>
				<?php kriesi_pagination($pages = '', $range = 2); ?>
				<!--div><?php posts_nav_link(); // default tag ?></div-->
				
			<div class="clearfix"></div>
		<?php if(of_get_option('blog_sidebar', '1')): ?></div><!-- close #content-container --><?php endif; ?>
		
<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>
	<?php get_template_part( 'no-results', 'index' ); ?>
<?php endif; ?>

<?php if(of_get_option('blog_sidebar', '1')): ?><?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>