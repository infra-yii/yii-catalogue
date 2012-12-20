<?php
/* @var $this ProductController */
/* @var $model CatalogueProduct */

$this->breadcrumbs = array(
    'Products' => array('index'),
    $model->title => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'Список продуктов', 'url' => array('index')),
    array('label' => 'Создать продукт', 'url' => array('create')),
    array('label' => 'Просмотр продукта', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Управление продуктами', 'url' => array('admin')),
);
?>

<h1>Update Product <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>