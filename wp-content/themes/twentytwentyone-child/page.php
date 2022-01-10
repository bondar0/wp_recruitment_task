<?php get_header(); ?>

<?php
    while ( have_posts() ) :
        the_post();
        the_content();

    endwhile; 
?>

<section class="workers">
    <h2 class="workers__title"><?php _e('Workers list', 'twentytwentyone'); ?></h2>
    <button type="button" class="button _button"><?php _e('Show workers list', 'twentytwentyone'); ?></button>
    <div class="workers__row _workers-row" data-post-id="<?php echo $post->ID; ?>" data-offset="0" data-nonce="<?php echo wp_create_nonce('ajax_load_field_nonce'); ?>" data-ajax-url="<?php echo admin_url('admin-ajax.php'); ?>" data-ajax-load-more="true"></div>
    <div class="workers__loading _workers-loading">Loading...</div>
</section>
<?php get_footer(); ?>