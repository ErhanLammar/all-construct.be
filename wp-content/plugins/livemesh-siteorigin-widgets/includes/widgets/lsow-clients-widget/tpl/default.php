<?php
/**
 * @var $clients
 */

?>

<?php $num_of_columns = intval($settings['per_line']); ?>

<?php $column_style = lsow_get_column_class($num_of_columns); ?>

<div class="lsow-clients lsow-container">

    <?php $column_count = 0; ?>

    <?php foreach ($clients as $client): ?>
        
        <?php $column_count%$num_of_columns == 0 ? ' lsow-last-row' : ''; ?>

        <div class="lsow-client <?php echo $column_style; ?> lsow-zero-margin">

            <?php echo wp_get_attachment_image($client['image'], 'full', false, array('class' => 'lsow-image full', 'alt' => $client['name'])); ?>

            <div class="lsow-client-name"><?php echo esc_html($client['name']); ?></div>

            <div class="lsow-image-overlay"></div>

        </div>

    <?php

    endforeach;

    ?>

</div>