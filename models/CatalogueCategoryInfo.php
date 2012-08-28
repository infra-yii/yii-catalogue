<?php

Yii::import('catalogue.models._base.BaseCatalogueCategoryInfo');

class CatalogueCategoryInfo extends BaseCatalogueCategoryInfo
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function relations()
    {
        return array(
            'category' => array(self::BELONGS_TO, $this->getModelClass(), 'category_id'),
        );
    }

    /**
     * @return CatalogueModule
     */
    private function getCatalogueModule()
    {
        return Yii::app()->getModule("catalogue");
    }

    private function getModelClass()
    {
        return $this->getCatalogueModule()->categoryModelClass;
    }
}