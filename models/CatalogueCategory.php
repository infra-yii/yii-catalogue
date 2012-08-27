<?php

Yii::import('catalogue.models._base.BaseCatalogueCategory');

class CatalogueCategory extends BaseCatalogueCategory
{
    /**
     * @static
     * @param null $className
     * @return CActiveRecord
     */
    public static function model($className = null)
    {
        if (!$className) $className = Yii::app()->getModule("catalogue")->categoryModelClass;
        return parent::model($className);
    }

    public function relations()
    {   $relations = parent::relations();
        unset ($relations['tblCatalogueCategories']);
        unset ($relations['catalogueProductInfos']);
        unset ($relations['tblCatalogueProperties']);

        $relations['products'] = array(self::MANY_MANY, Yii::app()->getModule("catalogue")->categoryModelClass, '{{catalogue_category_to_product}}(product_id, category_id)');
        $relations['info'] = array(self::HAS_ONE, Yii::app()->getModule("catalogue")->categoryInfoModelClass, 'category_id');
        $relations['properties'] = array(self::MANY_MANY, 'CatalogueProperty', '{{catalogue_property_to_category}}(category_id, property_id)');

        return $relations;
    }

    public function beforeSave()
    {
        parent::beforeSave();

        if (Yii::app()->getComponent("i18n2ascii")) {
            Yii::app()->getComponent("i18n2ascii")->setModelUrlAlias($this, $this->title);
        }
        return true;
    }

    /**
     * @param bool $normalize
     * @return array|string
     */
    public function url($normalize = true)
    {
        $u = array(Yii::app()->getModule("catalogue")->actionView, "id" => $this->path ? $this->path : $this->id);

        return $normalize ? CHtml::normalizeUrl($u) : $u;
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = array("properties", "safe");
        return $rules;
    }
    /**
     * @return mixed
     */
    public function getTree()
    {
        $categoryTree = Yii::app()->db->createCommand('SELECT * FROM tbl_category')->queryAll();

        return $this->_buildTree($categoryTree);
    }

    /**
     * @param $categories
     * @return mixed
     */
    private function _buildTree($categories)
    {

        $map = array(
            0 => array('subcategories' => array())
        );

        foreach ($categories as &$category) {
            $category['subcategories'] = array();
            $map[$category['id']] = &$category;
        }

        foreach ($categories as &$category) {
            $map[$category['parent_id']]['subcategories'][] = &$category;
        }

        return $map[0]['subcategories'];

    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['activerecord-relation'] = array(
            'class' => 'ext.yiiext.behaviors.activerecord-relation.EActiveRecordRelationBehavior',
        );
        return $behaviors;
    }

}