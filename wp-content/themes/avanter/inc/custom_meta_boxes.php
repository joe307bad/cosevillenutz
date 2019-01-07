<?php

$prefix = 'pageoptions_';

$fields = array(
	array( // Taxonomy Select box
		'label'	=> 'Portfolio Category', // <label>
		'desc'  => 'Choose what portfolio type you want to display on this page. <strong>Note</strong>: Works on Homepage and Portfolio Pages only.',// the description is created in the callback function with a link to Manage the taxonomy terms
		'id'	=> 'portfolio_type', // field id and name, needs to be the exact name of the taxonomy
		'type'	=> 'tax_select' // type of field
	),
	array( // Text Input
		'label'	=> 'Homepage Boxes Link', // <label>
		'desc'	=> 'Add a link for your homepage child page box.', // description
		'id'	=> $prefix.'home-box-link', // field id and name
		'type'	=> 'text' // type of field
	)
	
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$pageoptions_box = new custom_add_meta_box( 'pageoptions_box', 'Page Options', $fields, 'page', false );






$prefix = 'videoembed_';

$fields = array(
	array( // Text Input
		'label'	=> 'Audio/Video Embed Code', // <label>
		'desc'	=> 'Add your audio/video embed code here. This will replace your featured image.', // description
		'id'	=> $prefix.'videoembed', // field id and name
		'type'	=> 'textarea' // type of field
	),
	array( // Text Input
		'label'	=> 'External Link', // <label>
		'desc'	=> 'Have your post link to another page than the post page.', // description
		'id'	=> $prefix.'externallink', // field id and name
		'type'	=> 'text' // type of field
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$videoembed_box = new custom_add_meta_box( 'videoembed_box', 'Video Embed', $fields, 'post', false );




$prefix = 'portfoliooptions_';

$fields = array(
	array( // Text Input
		'label'	=> 'Video Embed Code', // <label>
		'desc'	=> 'Add your video embed code here.  This will replace your featured image.', // description
		'id'	=> $prefix.'videoembed', // field id and name
		'type'	=> 'textarea' // type of field
	),
	array( // Text Input
		'label'	=> 'Video Lightbox Link', // <label>
		'desc'	=> 'Paste in your video link here if you want to link to a video in the lightbox pop-up.', // description
		'id'	=> $prefix.'lightbox', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // Text Input
		'label'	=> 'External Link', // <label>
		'desc'	=> 'Paste in a link to an external document here.', // description
		'id'	=> $prefix.'externallink', // field id and name
		'type'	=> 'text' // type of field
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$portfoliooptions_box = new custom_add_meta_box( 'portfoliooptions_box', 'Portfolio Options', $fields, 'portfolio', false );


$prefix = 'slideroptions_';

$fields = array(
	array( // Text Input
		'label'	=> 'Right-Aligned Caption', // <label>
		'desc'	=> 'Type "true" to align the caption to the right.', // description
		'id'	=> $prefix.'slider_right', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // Text Input
		'label'	=> 'Center-Aligned Caption (No Background)', // <label>
		'desc'	=> 'Type "true" to display the secondary caption option', // description
		'id'	=> $prefix.'slider_secondary', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // Text Input
		'label'	=> 'Disable caption on slider?', // <label>
		'desc'	=> 'Type "true" to disable the slider caption.', // description
		'id'	=> $prefix.'slider_caption', // field id and name
		'type'	=> 'text' // type of field
	)
);


/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$portfoliooptions_box = new custom_add_meta_box( 'slideroptions_box', 'Slider Options', $fields, 'portfolio', false );




