<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 11);
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
    wp_enqueue_style( 'child-main-style', get_stylesheet_directory_uri() . '/css/main.css', array('parent-style'));
}

if(function_exists('acf_register_block_type')) {
	add_action('acf/init', 'register_acf_block_types');
}

function register_acf_block_types() {
	acf_register_block_type(array(
		'name' => 'hero',
		'title' => __('Hero'),
		'description' => __('Custom Hero Section.'),
		'render_template' => 'template-parts/blocks/hero/hero.php',
		'icon' => 'editor-paste-text',
		'keywords' => array('hero'),
	));
    acf_register_block_type(array(
		'name' => 'steps',
		'title' => __('Steps'),
		'description' => __('Custom Steps Section.'),
		'render_template' => 'template-parts/blocks/steps/steps.php',
		'icon' => 'editor-paste-text',
		'keywords' => array('steps'),
	));
}

/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	
	// Remove from TinyMCE
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter out the tinymce emoji plugin.
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
