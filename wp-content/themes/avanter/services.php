<?php
// Template Name: Services
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header();
?>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/services.css" />

<?php while (have_posts()): the_post();?>

		<div id="page-title">
		    <div class="width-container">
		        <h1 id="page-title-heading"><?php the_title();?></h1>
		    </div>
		</div>

		<?php endwhile;?>

<div class="width-container">

<?php
if (have_rows('service')):
    while (have_rows('service')): 
        ?> <div class="service"> <?php
        the_row();
        ?> <img src="<?php the_sub_field('service_image'); ?>" /><?php
        ?> <h3> <?php the_sub_field('service_title'); ?> </h3> <?php
        ?> <h4> <?php the_sub_field('service_subtitle'); ?>  </h4> <?php
        ?> <p> <?php the_sub_field('service_description'); ?> </p> <?php
        ?> </div> <?php
    endwhile;
endif;
?>
</div>