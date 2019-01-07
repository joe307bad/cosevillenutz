<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
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
		<?php if(of_get_option('shop_single_sidebar_display', '1')): ?><div id="content-container"><?php endif; ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>

		<div class="clearfix"></div>
	<?php if(of_get_option('shop_single_sidebar_display', '1')): ?></div><!-- close #content-container --><?php endif; ?>

	<?php if(of_get_option('shop_single_sidebar_display', '1')): ?><?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action('woocommerce_sidebar');
	?><?php endif; ?>

<?php get_footer('shop'); ?>