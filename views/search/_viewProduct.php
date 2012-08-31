<?php
/* @var $this ProductController */
/* @var $model CatalogueProduct */
?>

<div class="view">
    <?php echo CHtml::link(CHtml::encode($data->title), array('/product/view', 'id' => $data->id)); ?>
</div>