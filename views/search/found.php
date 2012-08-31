<?php if(!empty($search->string)): ?>
<h1>Поиск по слову "<i><?php echo CHtml::encode($search->string); ?></i>"</h1>
<?php endif; ?>

<b>Категории</b>:
<?php foreach($categories as $material): ?>
<?php
    $this->renderPartial('_view',array(
        'data'=>$material,
    ));
    ?>
<?php endforeach; ?>

<b>Продукты</b>:
<?php foreach($products as $material): ?>
<?php
    $this->renderPartial('_view',array(
        'data'=>$material,
    ));
    ?>
<?php endforeach; ?>

<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>