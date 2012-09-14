<?php
/* @var $this CategoryController */
/* @var $model CatalogueCategory */
?>

<div class="view">

    <?php echo CHtml::link(CHtml::encode($data->title), array(Yii::app()->getModule("catalogue")->actionProductView, 'id' => $data->id)); ?>
    <br/>

</div>