<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package progression
 * @since progression 1.0
 */
?>



<div id="page-title">
	<div class="width-container">
		<h1 id="page-title-heading"><?php printf( __( 'No Results: %s', 'progression' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
	</div>
</div>

<div id="main">
	<div class="width-container">
		<div id="content-container">
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
				<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'progression' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
			<?php elseif ( is_search() ) : ?>
				<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'progression' ); ?></p>
			<?php else : ?>
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'progression' ); ?></p>
			<?php endif; ?>
			<div class="clearfix"></div>
		</div><!-- close #content-container -->

