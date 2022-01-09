<?php

/**
 * Hero Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create class attribute allowing for custom "className" and "align" values.
$className = 'hero';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$hero_title = get_field('hero_title'); 
$hero_description = get_field('hero_description'); 
?>

<section class="<?php echo esc_attr($className); ?>">
    <div class="<?php echo esc_attr($className); ?>-block">
        <?php if($hero_title): ?>
            <h1 class="<?php echo esc_attr($className); ?>-block__title"><?php echo $hero_title; ?></h1>
        <?php endif; ?>
        
        <?php if($hero_description) : ?>
            <div class="<?php echo esc_attr($className); ?>-block__desc">
                <?php echo $hero_description; ?>
            </div>
        <?php endif; ?>
    </div>
</section>