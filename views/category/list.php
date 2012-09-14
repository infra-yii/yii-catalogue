<?php
/* @var $this CategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Categories' => array('index'),

);

$this->menu = array(
    array('label' => 'Create Category', 'url' => array('create')),
    array('label' => 'Manage Category', 'url' => array('admin')),
);
?>

<h1>Categories for <?=$model->title?></h1>

<?=CHtml::link("Compare", array("/catalogue/category/compare", "id"=>$model->id))?>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $categoryProvider,
    'itemView' => '_viewList',
)); ?>

<?php

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $productProvider,
    'itemView' => '_viewListProduct',
));
?>

