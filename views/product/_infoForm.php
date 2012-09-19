<div class="row">
    <?php echo CHtml::activelabelEx($model, 'Description'); ?>
    <?$form->wysiwyg($model, 'info[description]', array('rows' => 6, 'cols' => 50)) ?>
</div>

<div class="row">
    <?php echo CHtml::activelabelEx($model, 'Teh info'); ?>
    <?$form->wysiwyg($model, 'info[teh_info]', array('rows' => 6, 'cols' => 50)) ?>
</div>