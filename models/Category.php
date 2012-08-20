<?php

Yii::import('catalogue.models._base.BaseCategory');

class Category extends BaseCategory
{
    public static function model($className = null)
    {
        if (!$className) $className = Yii::app()->getModule("catalogue")->categoryModelClass;
        return parent::model($className);
    }
}