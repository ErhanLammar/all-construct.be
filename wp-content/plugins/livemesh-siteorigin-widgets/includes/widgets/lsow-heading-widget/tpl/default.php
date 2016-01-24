<?php
/**
 * @var $style
 * @var $heading
 * @var $subtitle
 * @var $short_text
 */

?>

<div class="lsow-heading lsow-<?php echo $style; ?>">

    <?php if ($style == 'style2' && !empty($subtitle)): ?>

        <h3 class="lsow-subtitle"><?php echo esc_html($subtitle); ?></h3>

    <?php endif; ?>

    <h3 class="lsow-title"><?php echo wp_kses_post($heading); ?></h3>

    <?php if (!empty($short_text)): ?>

        <p class="lsow-text"><?php echo wp_kses_post($short_text); ?></p>

    <?php endif; ?>

</div>