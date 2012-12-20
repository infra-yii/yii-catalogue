<?php
/* @var $this ProductController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Products',
);

$this->menu = array(
    array('label' => Yii::t('app', 'Создать продукт'), 'url' => array('create')),
    array('label' => Yii::t('app', 'Управление продуктами'), 'url' => array('admin')),
);
?>

<h1>Products</h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); ?>
