<div class="row">
    <?php echo CHtml::activelabelEx($model, 'Описание'); ?>
    <?$form->wysiwyg($model, 'info[description]', array('rows' => 6, 'cols' => 50)) ?>
</div>
