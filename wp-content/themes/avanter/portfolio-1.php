<?php
// Template Name: Portfolio 1 Column
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
if($count >= 2) { $count = 1; }
 ?>
<div class="portfolio-avanter">	
	<div class="grid1column <?php if($count == 1): echo ' lastcolumn'; endif; ?>">
		<div class="portfolio-index">
			<?php if(get_post_meta($post->ID, 'portfoliooptions_videoembed', true)): ?>
				<!-- iFrame Video Here --><div class="video-portfolio"><?php echo get_post_meta($post->ID, 'portfoliooptions_videoembed', true) ?></div>
			<?php else: ?>
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
						<?php $thumbnail = wp_get_attachment_image_src($attachment->ID, 'progression-portfolio-single'); ?>
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
					<?php the_post_thumbnail('progression-portfolio-single'); ?>
				</a>
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
		<div class="clearfix"></div>
	</div>
</div>
<?php if($count == 1): ?><div class="clearfix"></div><?php endif; ?>
<?php $count ++; $count_2++; endwhile; ?>

<div class="clearfix"></div>

<!-- normal pagination -->
<?php kriesi_pagination($portfolioloop->max_num_pages, $range = 2); ?>
<!-- end normal pagination -->

<?php if(of_get_option('page_comments_default', '0')): ?><?php comments_template( '', true ); ?><?php endif; ?>


<?php endif; ?>

<?php get_footer(); ?>