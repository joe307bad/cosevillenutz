<?php
add_action('widgets_init', 'pyre_homepage_portfolio_load_widgets');

function pyre_homepage_portfolio_load_widgets()
{
	register_widget('Pyre_Latest_Portfolio_Media_Widget');
}

class Pyre_Latest_Portfolio_Media_Widget extends WP_Widget {
	
	public function __construct()
	    {
		$widget_ops = array('classname' => 'pyre_homepage_media-port', 'description' => 'Latest Portfolio Posts');

		$control_ops = array('id_base' => 'pyre_homepage_media-widget-port');

		parent::__construct('pyre_homepage_media-widget-port', 'Progression Home: Portfolio Posts ', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		global $post;
		
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);
		$posts = $instance['posts'];
		$columns = $instance['columns'];
		$portfolioslug = $instance['portfolioslug'];
		
		$link_text = $instance['link_text'];
		$link_link = $instance['link_link'];
		
		echo $before_widget;
	 ?>
		
		
		
		</div><!-- close .width-container -->
		<div class="portfolio-homepage-widget">
		<div class="width-container">
			
		<?php if($title): ?>
			<h4 class="aligncenter"><?php echo $title; ?></h4>
		<?php endif; ?>

		<?php
		$portfolio_type = get_post_meta($post->ID, 'pyre_portfolio_type', true);
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'showposts' => $posts,
			'post_type' => 'portfolio',
			'tax_query' => array(
				array(
					'taxonomy' => 'portfolio_type',
					'field' => 'slug',
					'terms' => $portfolioslug,
				)
			),
			'paged' => $paged
		);
		$portfolio = new WP_Query($args);
		$portfolio_count = $portfolio->post_count;
		$count = 1;
		$count_2 = 1;
		while($portfolio->have_posts()): $portfolio->the_post();
			if($count >= $columns+1) { $count = 1; }
		?>
		<div class="home-child-boxes grid<?php echo $columns; ?>column<?php if($count == $columns): echo ' lastcolumn'; endif; ?>">
			<?php get_template_part( 'content', 'portfolio' ); ?>
		</div><!-- close .grid -->
		<?php if($count == $columns): ?><div class="clearfix"></div><?php endif; ?>
		<?php $count ++; $count_2++; endwhile; ?>
		
		
		<div class="clearfix"></div>
		
		<?php if($link_text): ?><div class="aligncenter"><a href="<?php echo $link_link; ?>" class="progression-button progression-medium progression-red"><?php echo $link_text; ?></a></div><?php endif; ?>
		
		</div><!-- close .width-container -->
		</div><!-- close .homepage-widget -->
		
		<div class="width-container">
	
			
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['posts'] = $new_instance['posts'];
		$instance['columns'] = $new_instance['columns'];
		$instance['portfolioslug'] = $new_instance['portfolioslug'];
		
		$instance['link_text'] = $new_instance['link_text'];
		$instance['link_link'] = $new_instance['link_link'];
		
		return $instance;
	}

	function form($instance)
	{
		
		$defaults = array('title' => 'Featured Works', 'posts' => 3, 'columns' => 3, 'portfolioslug' => 'featured', 'link_text' => 'View All Work', 'link_link' => '#');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		

		
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>">Number of posts:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('columns'); ?>">Number of columns (2-4):</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>" value="<?php echo $instance['columns']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('portfolioslug'); ?>">Portfolio Category Slug:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('portfolioslug'); ?>" name="<?php echo $this->get_field_name('portfolioslug'); ?>" value="<?php echo $instance['portfolioslug']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('link_text'); ?>">Button Text:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('link_text'); ?>" name="<?php echo $this->get_field_name('link_text'); ?>" value="<?php echo $instance['link_text']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('link_link'); ?>">Button Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('link_link'); ?>" name="<?php echo $this->get_field_name('link_link'); ?>" value="<?php echo $instance['link_link']; ?>" />
		</p>
		
	<?php }
}
?>