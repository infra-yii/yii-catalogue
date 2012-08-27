<?php

Yii::app()->clientScript->registerScript('properties', "
$(function(){

$('#properties').append('<span id=\"add\">+</span>');

$('#add').click(function(){

   $(this).prev().append('".CHtml::activelabelEx($model, 'Properties').CHtml::activeTextField($model, 'properties[][title]', array('rows' => 6, 'cols' => 50,))."');

});




});
");

?>
<fieldset id="properties">
    <div class="row">
        <? if ($model->properties){ ?>
            <?foreach($model->properties as $property){?>
                <?php echo CHtml::activelabelEx($model, 'Properties'); ?>
                <?php echo CHtml::activeTextField($model, 'properties['.$property->id.'][title]', array('rows' => 6, 'cols' => 50, 'value'=>$property)) ?>
                <?php echo CHtml::activeCheckBox($model, 'properties['.$property->id.'][delete]', array('title'=>'delete')) ?>
            <? } ?>
        <? }else{ ?>
            <?php echo CHtml::activelabelEx($model, 'Properties'); ?>
            <?php echo CHtml::activeTextField($model, 'properties[][title]', array('rows' => 6, 'cols' => 50,)) ?>
        <? } ?>
    </div>
</fieldset>