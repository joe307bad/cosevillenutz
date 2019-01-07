<?php
// Template Name: Full Width
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>


<?php while ( have_posts() ) : the_post(); ?>
	<div id="page-title">
		<div class="width-container">
			<h1 id="page-title-heading"><?php the_title(); ?></h1>
		</div>
	</div>
	
	<div id="main">
		<div class="width-container">
			<?php the_content(); ?>		
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'progression' ), 'after' => '</div>' ) ); ?>
			<?php if(of_get_option('page_comments_default', '0')): ?><?php comments_template( '', true ); ?><?php endif; ?>
			<div class="clearfix"></div>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>




