<?php
// Template Name: Contact Page Full Width
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
	
	<?php if(of_get_option('contact_map_text')): ?>
		<script src="https://maps.google.com/maps/api/js<?php if (get_theme_mod( 'progression_studios_google_maps_api')) : ?>?key=<?php echo esc_attr(get_theme_mod('progression_studios_google_maps_api')); ?><?php endif ?>" type="text/javascript"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.gomap-1.3.2.min.js"></script>
		<div id="map-contact"></div>
		<script type="text/javascript"> 
		jQuery(document).ready(function($) {
		    $("#map-contact").goMap({ 
		        markers: [{  
		            address: '<?php echo of_get_option("contact_map_text", "Santa Rosa, CA"); ?>', 
		            title: 'marker title 1' ,
					icon: '<?php echo get_template_directory_uri(); ?>/images/pin.png'
		        }],
				disableDoubleClickZoom: true,
								zoom: 12,
								navigationControl: true,
								mapTypeControl: false, 
								 scrollwheel: false, 
								
				maptype: 'ROADMAP'
		    }); 
		});
		</script>
	<?php endif; ?>
	
	<div id="main">
		
		<div class="width-container">
				<?php the_content(); ?>	
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'progression' ), 'after' => '</div>' ) ); ?>
				<?php if(of_get_option('page_comments_default', '0')): ?><?php comments_template( '', true ); ?><?php endif; ?>
			<div class="clearfix"></div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>