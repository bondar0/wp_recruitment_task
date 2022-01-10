<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 11);
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
    wp_enqueue_style( 'child-main-style', get_stylesheet_directory_uri() . '/css/main.css', array('parent-style'));
    
    wp_enqueue_script("jquery");
    
    wp_enqueue_script( 'main-js', get_stylesheet_directory_uri(). '/js/all.min.js', array('jquery'), true );
    
    
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

// add action for logged in users
add_action('wp_ajax_ajax_load_more', 'ajax_load_more');
// add action for non logged in users
add_action('wp_ajax_nopriv_ajax_load_more', 'ajax_load_more');

function ajax_load_more() {
    
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'ajax_load_field_nonce')) {
        exit;
    }
    
    if (!isset($_POST['post_id']) || !isset($_POST['offset'])) {
        return;
    }
    $show = 4; 
    $start = $_POST['offset'];
    $end = $start+$show;
    $post_id = $_POST['post_id'];
    
    ob_start();
    if (have_rows('workers_list', $post_id)) {
        $total = count(get_field('workers_list', $post_id));
        $count = 0;
        while (have_rows('workers_list', $post_id)) {
            the_row();
            $worker_image = get_sub_field('worker_image');
            $worker_name = get_sub_field('worker_name');
            if ($count < $start) {
                // we have not gotten to where
                // we need to start showing
                // increment count and continue
                $count++;
                continue;
            }
            ?><div class="worker">
                <?php if( !empty( $worker_image ) ): ?>
                    <div class="worker__image">
                        <img src="<?php echo esc_url($worker_image['url']); ?>" alt="<?php echo esc_attr($worker_image['alt']); ?>" />
                    </div>
                <?php endif; ?>
                <?php if($worker_name): ?>
                    <p class="worker__name"><?php echo $worker_name; ?></p>
                <?php endif; ?>
            </div><?php 
            $count++;
            if ($count == $end) {
                // we've shown the number, break out of loop
                break;
            }
        } // end while have rows
    } // end if have rows
    $content = ob_get_clean();
    // check to see if we've shown the last item
    $more = false;
    if ($total > $count) {
        $more = true;
    }
    // output our 3 values as a json encoded array
    echo json_encode(array('content' => $content, 'more' => $more, 'offset' => $end));
    exit;
} // end function ajax_load_more

// this will load the example field group included
// you only need this when setting up this example
// it should be removed if you're using your own field group
add_action('acf/include_fields', 'load_repeater_more_example_group');
function load_repeater_more_example_group() {
    $file = dirname(__FILE__).'/acf-json/group_61dc56ca0ed09.json';
    $json = file_get_contents($file);
    $group = json_decode($json, true);
    acf_add_local_field_group($group);
} // end function load_repeater_more_example_group

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
