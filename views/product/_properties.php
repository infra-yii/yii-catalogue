<?php


print_r($modelCategory->properties);

?>

<fieldset id="properties">
    <div class="row">
        <? /*if ($model->properties){ ?>
            <?foreach($model->properties as $property){?>
                <?php echo CHtml::activelabelEx($model, 'Properties'); ?>
                <?php echo CHtml::activeTextField($model, 'properties['.$property->id.'][title]', array('rows' => 6, 'cols' => 50, 'value'=>$property)) ?>
            <? } ?>
        <? } */?>
    </div>
</fieldset>