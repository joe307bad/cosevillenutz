<?php
add_action('widgets_init', 'homefeature_load_widgets');

function homefeature_load_widgets()
{
	register_widget('homefeature_Widget');
}

class homefeature_Widget extends WP_Widget {
	
	public function __construct()
	    {
		$widget_ops = array('classname' => 'homefeature', 'description' => 'Add-in a featured box to your homepage');

		$control_ops = array('id_base' => 'homefeature-widget');

		parent::__construct('homefeature-widget', 'Progression Home: Featured Box', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		
		$text_contact_1 = $instance['text_contact_1'];
		$text_contact_2 = $instance['text_contact_2'];

		echo $before_widget;

	 ?>
		
		<div id="featured-avanter">
			<div id="featured-avanter-container"><?php if($title): ?><?php echo $title; ?><?php endif; ?></div>
			<?php if($text_contact_1): ?><?php if($text_contact_2): ?><a href="<?php echo $text_contact_2; ?>" id="featured-avanter-button"><?php echo $text_contact_1; ?></a><?php endif; ?><?php endif; ?>
			<div class="clearfix"></div>
		</div>
		
		

		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text_contact_1'] = $new_instance['text_contact_1'];
		$instance['text_contact_2'] = $new_instance['text_contact_2'];

		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Avanter offers the best way to bring your business and portfolio online!', 'text_contact_1' => 'Sign Up Now', 'text_contact_2' => '#');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('text_contact_1'); ?>">Additional Text:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('text_contact_1'); ?>" name="<?php echo $this->get_field_name('text_contact_1'); ?>" value="<?php echo $instance['text_contact_1']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('text_contact_2'); ?>">Text Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('text_contact_2'); ?>" name="<?php echo $this->get_field_name('text_contact_2'); ?>" value="<?php echo $instance['text_contact_2']; ?>" />
		</p>
		
	<?php
	}
}
?>