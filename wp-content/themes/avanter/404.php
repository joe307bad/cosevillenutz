<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>


<div id="page-title">
	<div class="width-container">
		<h1 id="page-title-heading"><?php _e( 'Oops! That page can&rsquo;t be found.', 'progression' ); ?></h2>
	</div>
</div>

<div id="main">
	<div class="width-container">
			<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below.', 'progression' ); ?></p><Br><br>
			
			<?php the_widget( 'WP_Widget_Recent_Posts' ); ?><br><br>
			
			<?php if ( progression_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
			<div class="widget widget_categories">
				<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'progression' ); ?></h2>
				<ul>
				<?php
					wp_list_categories( array(
						'orderby'    => 'count',
						'order'      => 'DESC',
						'show_count' => 1,
						'title_li'   => '',
						'number'     => 10,
					) );
				?>
				</ul>
			</div><!-- .widget -->
			<Br><br>
			<?php endif; ?>
			
			
			<?php
			/* translators: %1$s: smiley */
			$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives.', 'progression' ), convert_smilies( ':)' ) ) . '</p>';
			the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
			?>

<?php get_footer(); ?>