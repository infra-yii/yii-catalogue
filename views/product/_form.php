<?php
/* @var $this ProductController */
/* @var $model CatalogueProduct */
/* @var $form ExtForm */
Yii::app()->clientScript->registerScript('base_category_id', "
$(function(){

var base_category = '" . $model->base_category_id . "';
var selects_cat ='';

$('.categories option:selected').each(function () {
    selects_cat += '<option value=\"'+ $(this).val() +'\">'+  $(this).text() +'</option> ';
});

$('.base_category').html(selects_cat);

if(base_category!=''){
    $('.base_category').val(base_category);
}

$('.categories').change(function(){
    selects_cat = '';

    $('.categories option:selected').each(function () {
        selects_cat += '<option value=\"'+ $(this).val() +'\">'+  $(this).text() +'</option> ';
    });

    $('.base_category').html(selects_cat);
});


});
");
?>

<div class="form">

    <?php $form = $this->beginWidget('ext.shared-core.widgets.ExtForm', array(
    "model"=>$model,
    'id' => 'product-form',
    'enableAjaxValidation' => false,
)); ?>

    <p class="note">Поля отмеченные <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'categories'); ?>
        <?php echo $form->listBox($model, 'categories',
        CHtml::listData(Category::model()->findAll(), 'id', 'title'),
        array('multiple' => 'multiple', 'class' => 'categories')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'base_category_id'); ?>
        <?php echo $form->dropDownList($model, 'base_category_id',
        CHtml::listData(Category::model()->findAll(), 'id', 'title'),
        array('class' => 'base_category')); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'path'); ?>
        <?php echo $form->textField($model, 'path', array('size' => 60, 'maxlength' => 64)); ?>
        <?php echo $form->error($model, 'path'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'short_description'); ?>
        <?php echo $form->textArea($model, 'short_description', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'short_description'); ?>
    </div>

    <?$form->inject()?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->