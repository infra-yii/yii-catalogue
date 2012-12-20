<?php
Yii::app()->clientScript->registerScript('properties', "
$(function(){

$('#properties').append('<span id=\"add\">+</span>');

$('#add').click(function(){

   $(this).prev().append('" . $form->labelEx($model, "properties") . CHtml::textField('newProperties[]') . "');

});

});
");
$inheritedProps = $model->collectProperties(true);
?>
<div id="properties">
    <?if(count($inheritedProps)) {?>
    <div class="row">
        <?foreach($inheritedProps as $prop) {?>
            <?php echo CHtml::label("Inherited property", "inherit[".$prop->id."]"); ?>
            <?php echo CHtml::textField('inherit['.$prop->id.']', $prop->title, array("disabled"=>true)) ?>
        <?}?>
    </div>
    <?}?>

    <div class="row">
        <?foreach ($model->properties as $property) { ?>
            <?php echo CHtml::activeLabelEx($model, 'Свойства'); ?>
            <?php echo CHtml::textField('properties[' . $property->id . '][title]', $property->title) ?>
            <?php echo CHtml::checkBox('properties[' . $property->id . '][delete]', false, array("title" => "Delete")) ?>
        <? } ?>
        <?=$form->labelEx($model, "properties")?>
        <?php echo CHtml::textField("newProperties[]")?>
    </div>
</div>