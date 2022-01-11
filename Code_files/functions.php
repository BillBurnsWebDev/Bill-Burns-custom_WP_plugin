<?php
// enqueue styles for child theme
// @ https://digwp.com/2016/01/include-styles-child-theme/
function example_enqueue_styles()
{
// enqueue parent styles
wp_enqueue_style('parent-theme', get_template_directory_uri() .'/style.css');
// enqueue child styles
wp_enqueue_style('child-theme', get_stylesheet_directory_uri() .'/style.css', array('parent-theme'));
}
add_action('wp_enqueue_scripts', 'example_enqueue_styles');
?>
