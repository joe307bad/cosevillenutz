<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); ?>

<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
	
	<div id="page-title">
		<div class="width-container">
			<h1 id="page-title-heading"><?php woocommerce_page_title(); ?></h1>
		</div>
	</div>

<?php endif; ?>

<div id="main">
	<div class="width-container">
		<?php if(of_get_option('shop_sidebar_display', '1')): ?><div id="content-container"><?php endif; ?>


	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');
	?>

		
		<?php do_action( 'woocommerce_archive_description' ); ?>
		<?php if ( have_posts() ) : ?>

			<?php do_action( 'woocommerce_before_shop_loop' ); ?>

			<?php woocommerce_product_loop_start(); ?>

			<?php if ( wc_get_loop_prop( 'total' )  ) : ?>
				
				<?php while ( have_posts() ) : the_post(); ?>

					<?php 
					do_action( 'woocommerce_shop_loop' );
					wc_get_template_part( 'content', 'product' );
					?>

				<?php endwhile; // end of the loop. ?>
			<?php endif; ?>
			
			<?php woocommerce_product_loop_end(); ?>

			<?php do_action( 'woocommerce_after_shop_loop' ); ?>

		<?php else : ?>

			<?php do_action( 'woocommerce_no_products_found' ); ?>

		<?php endif; ?>
		
	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>
	
	<div class="clearfix"></div>
<?php if(of_get_option('shop_sidebar_display', '1')): ?></div><!-- close #content-container --><?php endif; ?>

	<?php if(of_get_option('shop_sidebar_display', '1')): ?><?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action('woocommerce_sidebar');
	?><?php endif; ?>
	

<?php get_footer('shop'); ?>