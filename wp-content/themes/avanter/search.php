<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>
	<div id="page-title">
		<div class="width-container">
			<h1 id="page-title-heading"><?php printf( __( 'Search Results for: %s', 'progression' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</div>
	</div>
	
	<div id="main">
		<div class="width-container">
			<div id="content-container">
				
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'search' ); ?>
				<?php endwhile; ?>
				
				<div class="clearfix"></div>
				<?php kriesi_pagination($pages = '', $range = 2); ?>
				<!--div><?php posts_nav_link(); // default tag ?></div-->
				
			<div class="clearfix"></div>
		</div><!-- close #content-container -->
		
<?php else : ?>
	<?php get_template_part( 'no-results', 'search' ); ?>
<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>