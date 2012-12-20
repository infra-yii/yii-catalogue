<?php
/* @var $this ProductController */
/* @var $model CatalogueProduct */

$this->breadcrumbs = array(
    'Products' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'Список продуктов', 'url' => array('index')),
    array('label' => 'Управление продуктами', 'url' => array('admin')),
);
?>

<h1>Create Product</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>