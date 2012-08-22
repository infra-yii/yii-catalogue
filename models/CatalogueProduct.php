<?php

Yii::import('catalogue.models._base.BaseProduct');

/**
 * @property CatalogueProductInfo $info
 */
class CatalogueProduct extends BaseProduct
{

    public static function model($className = null)
    {
        if (!$className) $className = Yii::app()->getModule("catalogue")->productModelClass;
        return parent::model($className);
    }

    public function relations()
    {   $relations = parent::relations();
        unset ($relations['tblCategories']);
        unset ($relations['productInfos']);

        $relations['categories'] = array(self::MANY_MANY, Yii::app()->getModule("catalogue")->categoryModelClass, '{{category_to_product}}(product_id, category_id)');
        $relations['info'] = array(self::HAS_ONE, Yii::app()->getModule("catalogue")->productInfoModelClass, 'product_id');

        return $relations;
    }

    public function pivotModels()
    {
        return array(
            'categories' => 'CategoryToProduct',
        );
    }

    public function beforeSave()
    {   parent::beforeSave();
        if(Yii::app()->getComponent("i18n2ascii")) {
            Yii::app()->getComponent("i18n2ascii")->setModelUrlAlias($this, $this->title);
        }
        return true;
    }

    public function url($normalize = false)
    {
        $u = array(Yii::app()->getModule("catalogue")->actionProductView, "id" => $this->path ? $this->path : $this->id);

        return $normalize ? CHtml::normalizeUrl($u) : $u;
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = array("categories", "safe");
        $rules[] = array("base_category_id", "safe");
        return $rules;
    }

    public function behaviors()
    {   $behaviors = parent::behaviors();
        $behaviors['activerecord-relation'] = array(
                'class' => 'ext.yiiext.behaviors.activerecord-relation.EActiveRecordRelationBehavior',
            );
        return $behaviors;
    }

    /**
     * @param $path
     * @return CActiveRecord
     */
    public function findByPath($path)
    {
        return $this->findByAttributes(array("path" => $path));
    }
}