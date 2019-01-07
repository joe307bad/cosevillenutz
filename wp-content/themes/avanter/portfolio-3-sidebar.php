<?php
// Template Name: Portfolio 3 Column w/Sidebar
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>

<?php while(have_posts()): the_post(); ?>

	<div id="page-title">
		<div class="width-container">
			<h1 id="page-title-heading"><?php the_title(); ?></h1>
		</div>
	</div>
	

<div id="main">
	<div class="width-container">
		<div id="content-container">
		<?php the_content(); ?>	
		
<?php endwhile; ?>
		
		<?php get_template_part( 'child-page', 'navigation' ); ?>

<?php
$port_number_posts = of_get_option('portfolio_page_posts',6);
$portfolio_type = get_the_term_list( $post->ID, 'portfolio_type' );
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$portfolioloop = new WP_Query(array(
	'posts_per_page' => $port_number_posts,
    'paged'          => $paged,
    'post_type'      => 'portfolio',
    'tax_query'      => array(
        // Note: tax_query expects an array of arrays!
        array(
            'taxonomy' => 'portfolio_type', // my guess
            'field'    => 'name',
            'terms'    => $portfolio_type
        )
    ),
));

$count = 1;
$count_2 = 1;

?>

<?php if ( have_posts() ) : while ( $portfolioloop->have_posts() ) : $portfolioloop->the_post();
if($count >= 4) { $count = 1; }
 ?>
<div class="portfolio-avanter">	
	<div class="grid3column <?php if($count == 3): echo ' lastcolumn'; endif; ?>">
		<?php get_template_part( 'content', 'portfolio' ); ?>
	</div>
</div>
<?php if($count == 3): ?><div class="clearfix"></div><?php endif; ?>
<?php $count ++; $count_2++; endwhile; ?>

<div class="clearfix"></div>

<!-- normal pagination -->
<?php kriesi_pagination($portfolioloop->max_num_pages, $range = 2); ?>
<!-- end normal pagination -->

<?php if(of_get_option('page_comments_default', '0')): ?><?php comments_template( '', true ); ?><?php endif; ?>


<?php endif; ?>
</div><!-- close #content-container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>