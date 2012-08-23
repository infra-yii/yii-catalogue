<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
    'Categories'=>array('index'),
    'Tree',
);

$this->menu=array(
    array('label'=>'List Category', 'url'=>array('index')),
    array('label'=>'Create Category', 'url'=>array('create')),
);