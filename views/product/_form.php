<?php
/* @var $this ProductController */
/* @var $model CatalogueProduct */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScript('base_category_id', "
$(function(){

var base_category = '".$model->base_category_id."';
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

// images holder integration
$modelRefl = new ReflectionClass($model);
$imageHolders = array();
if($modelRefl->implementsInterface("ImagesHolderModel")) {
    foreach($model->imageHolders() as $h=>$t) {
        $h = str_replace(" ", "", ucwords(str_replace("_", " ", substr($h, 0, -3))));
        $h[0] = strtolower($h[0]);
        $imageHolders[$h] = $t;
    }
}
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <div class="row">
            <?php echo $form->labelEx($model,'categories'); ?>
            <?php echo $form->listBox($model, 'categories',
                CHtml::listData(Category::model()->findAll(), 'id', 'title'),
                array('multiple' => 'multiple','class'=>'categories')); ?>
        </div>

    <div class="row">
        <?php echo $form->labelEx($model,'base_category_id'); ?>
        <?php echo $form->dropDownList($model, 'base_category_id',
            CHtml::listData(Category::model()->findAll(), 'id', 'title'),
            array('class'=>'base_category')); ?>
    </div>
        
        
	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'path'); ?>
        <?php echo $form->textField($model,'path',array('size'=>60,'maxlength'=>64)); ?>
        <?php echo $form->error($model,'path'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'short_description'); ?>
		<?php echo $form->textArea($model,'short_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'short_description'); ?>
	</div>

    <? if ($infoForm) $this->renderPartial($infoForm, array("model" => $model))?>


    <?if(count($imageHolders)){?>
    <fieldset>
        <?foreach($imageHolders as $field=>$type) $this->widget("imagesHolder.widgets.heldImages.EditImages", array("holder"=>(($model && $model->$field) ? $model->$field : $type))) ?>
    </fieldset>
    <?}?>

    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->