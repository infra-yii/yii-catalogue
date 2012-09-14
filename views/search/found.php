<?php if(!empty($search->string)): ?>
<h1>Поиск по слову "<i><?php echo CHtml::encode($search->string); ?></i>"</h1>
<?php endif; ?>
<?php if(count($categories) > 0): ?>
    <b>Категории</b>:
    <?php foreach($categories as $material): ?>
    <?php
        $this->renderPartial('_viewCategory',array(
            'data'=>$material,
        ));
        ?>
    <?php endforeach; ?>
<?php endif ?>

<?php if(count($products) > 0): ?>
    <b>Продукты</b>:
    <?php foreach($products as $material): ?>
    <?php
        $this->renderPartial('_viewProduct',array(
            'data'=>$material,
        ));
        ?>
    <?php endforeach; ?>
<?php endif ?>

<?php if( count($categories) == 0 && count($products) == 0):?>
    Ничего не найденно
<?php endif ?>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>