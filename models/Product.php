<?php

Yii::import('catalogue.models._base.BaseProduct');

/**
 * @property ProductInfo $info
 */
class Product extends BaseProduct
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function relations()
    {
        return array(
            'categories' => array(self::MANY_MANY, 'Category', '{{category_to_product}}(product_id, category_id)'),
            'info' => array(self::HAS_ONE, 'ProductInfo', 'product_id'),
        );
    }

    public function pivotModels()
    {
        return array(
            'categories' => 'CategoryToProduct',
        );
    }

    /*public function afterConstruct(){
        $this->info = new ProductInfo();

    }

    /*public function setAttributes($values,$safeOnly=true)
    {   parent::setAttributes($values,$safeOnly);
        if(!$this->info) $this->info = new ProductInfo();
        $this->info->attributes = $values['info'];
    }

    /*public function afterSave(){
        $this->info->product = $this;
        parent::afterSave();
        $this->info->save();


    }*/

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = array("categories", "safe");
        return $rules;
    }

    public function behaviors()
    {
        return array(
            'activerecord-relation' => array(
                'class' => 'ext.yiiext.behaviors.activerecord-relation.EActiveRecordRelationBehavior',
            )
        );
    }
}