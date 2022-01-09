<?php

/**
 * Steps Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create class attribute allowing for custom "className" and "align" values.
$className = 'steps';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$steps_image = get_field('steps_image');
?>

<section class="<?php echo esc_attr($className); ?>" style="background-image:url('<?php echo $steps_image['url']; ?>');">
<?php if( have_rows('steps') ): ?>
    <?php $count = 1; while( have_rows('steps') ): the_row(); 
        $text_step = get_sub_field('text_step');
        ?>
        <div class="step-item">
            <?php if($text_step):?>
                <div class="step-item__desc">
                    <?php echo $text_step; ?>
                </div>
            <?php endif; ?>
                <div class="step-item__number">
                    <?php echo $count; ?>
                </div>
        </div>
    <?php $count++; endwhile; ?>
<?php endif; ?>
</section>