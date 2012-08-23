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
    {
        return array(
            'products' => array(self::MANY_MANY, 'Product', '{{category_to_product}}(product_id, category_id)', 'together' => true),
            'info' => array(self::HAS_ONE, 'CategoryInfo', 'category_id'),
        );
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

}