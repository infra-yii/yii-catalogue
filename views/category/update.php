<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs = array(
    'Categories' => array('index'),
    $model->title => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'Список категорий', 'url' => array('index')),
    array('label' => 'Создать категорию', 'url' => array('create')),
    array('label' => 'Просмотр категории', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Управление категориями', 'url' => array('admin')),
);
?>

<h1>Update Category <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>