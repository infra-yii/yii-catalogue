<?php
/* @var $this CategoryController */
/* @var $model Category */
?>

<div class="view">
    <?php echo CHtml::link(CHtml::encode($data->title), array('category/list', 'id' => $data->id)); ?>
    <br/>
</div>