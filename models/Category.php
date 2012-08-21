<?php

Yii::import('catalogue.models._base.BaseCategory');

class Category extends BaseCategory
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