<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
$module = Yii::app()->getModule("catalogue");

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
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<?php echo $form->dropDownList($model,'parent_id', array("0"=>"None") + CHtml::listData(Category::model()->findAll(), 'id', 'title')); ?>
		<?php echo $form->error($model,'parent_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sorting'); ?>
		<?php echo $form->dropDownList($model,'sorting', range(0, 100)); ?>
		<?php echo $form->error($model,'sorting'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'path'); ?>
        <?php echo $form->textField($model,'path',array('size'=>60,'maxlength'=>200)); ?>
        <?php echo $form->error($model,'path'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

    <?$this->renderPartial($infoform, array("model" => $model))?>

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