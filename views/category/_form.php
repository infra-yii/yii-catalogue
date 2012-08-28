<?php
/* @var $this CategoryController */
/* @var $model CatalogueCategory */
/* @var $form ExtForm */
$module = Yii::app()->getModule("catalogue");

?>

<div class="form">

    <?php $form = $this->beginWidget('ext.shared-core.widgets.ExtForm', array(
    "model"=>$model,
    'id' => 'category-form',
    'enableAjaxValidation' => false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'parent_id'); ?>
        <?php echo $form->dropDownList($model, 'parent_id', array("" => "None") + CHtml::listData(Category::model()->findAll(), 'id', 'title')); ?>
        <?php echo $form->error($model, 'parent_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'sorting'); ?>
        <?php echo $form->dropDownList($model, 'sorting', range(0, 100)); ?>
        <?php echo $form->error($model, 'sorting'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <?$form->inject()?>

    <div class="row">
        <?php echo $form->labelEx($model, 'path'); ?>
        <?php echo $form->textField($model, 'path', array('size' => 60, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'path'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->