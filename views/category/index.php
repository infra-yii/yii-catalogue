<?php
/* @var $this CategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Categories',
);

$this->menu = array(
    array('label' => 'Создать категорию', 'url' => array('create')),
    array('label' => 'Управление категориями', 'url' => array('admin')),
);
?>

<h1>Categories Root</h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); ?>
