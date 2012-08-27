<?php

Yii::import('catalogue.models._base.BaseCatalogueProperty');

class CatalogueProperty extends BaseCatalogueProperty
{
    public static function model($className = null)
    {
        if (!$className) $className = Yii::app()->getModule("catalogue")->categoryPropertiesModelClass;
        return parent::model($className);
    }

    public function relations()
    {
        $relations = parent::relations();

        $relations['properties'] = Yii::app()->getModule("catalogue")->categoryModelClass;


        return $relations;
    }
}