<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <div class="row">
            <?php echo $form->labelEx($model,'categories'); ?>
            <?php echo $form->listBox($model, 'categories',
            CHtml::listData(Category::model()->findAll(), 'id', 'title'),
            array('multiple' => 'multiple')); ?>
        </div>
        
        
	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'short_description'); ?>
		<?php echo $form->textArea($model,'short_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'short_description'); ?>
	</div>



    <?$this->renderPartial('_info', array("model" => $model))?>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->