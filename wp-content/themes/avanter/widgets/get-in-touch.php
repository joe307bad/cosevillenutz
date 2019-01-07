<?php
add_action('widgets_init', 'our_hours_load_widgets');

function our_hours_load_widgets()
{
	register_widget('Our_Hours_Widget');
}

class Our_Hours_Widget extends WP_Widget {
	
	public function __construct()
	    {
		$widget_ops = array('classname' => 'hours', 'description' => 'Full Width Get in Touch Widget');

		$control_ops = array('id_base' => 'our-hours-widget');

		parent::__construct('our-hours-widget', 'Progression Full Width: Get In Touch', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$text_contact_1 = $instance['text_contact_1'];
		$text_contact_2 = $instance['text_contact_2'];
		$text_contact_3 = $instance['text_contact_3'];
		$text_contact_4 = $instance['text_contact_4'];


		echo $before_widget;
	 ?>
		
		<!-- start contact widget -->
		<div id="contact-base-avanter">
			<div class="width-container">
				<?php if($title): ?><?php echo $title; ?><br><br><?php endif; ?>
				<?php if($text_contact_1): ?><?php echo $text_contact_1; ?><br><?php endif; ?>
				<?php if($text_contact_2): ?><div id="phone-avanter"><?php echo $text_contact_2; ?> <?php if($text_contact_3): ?>- <a href="mailto:<?php echo $text_contact_3; ?>"><?php echo $text_contact_3; ?></a><?php endif; ?></div><?php endif; ?>
				<?php if($text_contact_4): ?><br><?php echo $text_contact_4; ?><?php endif; ?>
				<div class="clearfix"></div>
			</div><!-- close .width-container -->
		</div><!-- close #contact-base-avanter -->
		<!-- end contact widget -->
	

		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text_contact_1'] = $new_instance['text_contact_1'];
		$instance['text_contact_2'] = $new_instance['text_contact_2'];
		$instance['text_contact_3'] = $new_instance['text_contact_3'];
		$instance['text_contact_4'] = $new_instance['text_contact_4'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Get in touch', 'text_contact_1' => 'Address here', 'text_contact_2' => 'Phone', 'text_contact_3' => 'info@avanter.com', 'text_contact_4' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('text_contact_1'); ?>">Address Line:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('text_contact_1'); ?>" name="<?php echo $this->get_field_name('text_contact_1'); ?>" value="<?php echo $instance['text_contact_1']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('text_contact_2'); ?>">Phone:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('text_contact_2'); ?>" name="<?php echo $this->get_field_name('text_contact_2'); ?>" value="<?php echo $instance['text_contact_2']; ?>" />
		</p>

		
		<p>
			<label for="<?php echo $this->get_field_id('text_contact_3'); ?>">Email Address:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('text_contact_3'); ?>" name="<?php echo $this->get_field_name('text_contact_3'); ?>" value="<?php echo $instance['text_contact_3']; ?>" />
		</p>


		
		<p>
			<label for="<?php echo $this->get_field_id('text_contact_4'); ?>">Additional Field:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('text_contact_4'); ?>" name="<?php echo $this->get_field_name('text_contact_4'); ?>" value="<?php echo $instance['text_contact_4']; ?>" />
		</p>

	
		
	<?php
	}
}
?>