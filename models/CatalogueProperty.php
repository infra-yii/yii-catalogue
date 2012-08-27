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

        $relations['categories'] = array(self::BELONGS_TO, Yii::app()->getModule("catalogue")->categoryModelClass, "category_id");

        return $relations;
    }
}