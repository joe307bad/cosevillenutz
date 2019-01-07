<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package progression
 * @since progression 1.0
 */
?>
<div class="clearfix"></div>
</div><!-- close .width-container -->
</div><!-- close #main -->

<?php if( is_page_template('homepage.php') || is_page_template('page-blog-slider.php') ): ?>
	<?php if ( ! dynamic_sidebar( 'Homepage Footer Widgets' ) ) : ?>
	<?php endif; // end sidebar widget area ?>
<?php endif; ?>

<footer>
	<div id="footer-widgets">
		<div class="width-container footer-<?php echo of_get_option('footer_widgets_column', '3'); ?>-column">
			<?php if ( ! dynamic_sidebar( 'Footer Widgets' ) ) : ?>
			<?php endif; // end sidebar widget area ?>
			<div class="clearfix"></div>
		</div><!-- close .width-container -->
	</div><!-- close #widget-area -->
	
	<div class="width-container">
		<div id="copyright">
			<div class="grid2column">
				<?php echo of_get_option('copyright_textarea', '&copy; 2015 Avanter Inc.'); ?>
			</div>
			<div class="grid2column lastcolumn">
				<?php get_template_part( 'social', 'footer' ); ?>
			</div>
			<div class="clearfix"></div>
		</div><!-- close #copyright -->
	</div><!-- close .width-container -->
</footer>
<?php wp_footer(); ?>
</body>
</html>