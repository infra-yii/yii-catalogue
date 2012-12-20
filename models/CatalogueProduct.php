<?php

Yii::import('catalogue.models._base.BaseCatalogueProduct');

/**
 * @property CatalogueProductInfo $info
 * @property CataloguePropertyValue[] propertiesValues
 * @property CatalogueCategory[] categories
 */
class CatalogueProduct extends BaseCatalogueProduct implements IFormPartialsInject
{

    public static function model($className = null)
    {
        if (!$className) $className = Yii::app()->getModule("catalogue")->productModelClass;
        return parent::model($className);
    }

    public function relations()
    {
        $relations = parent::relations();
        unset ($relations['tblCatalogueCategories']);
        unset ($relations['catalogueProductInfos']);
        unset ($relations['cataloguePropertiesValues']);
        $relations['categories'] = array(self::MANY_MANY, Yii::app()->getModule("catalogue")->categoryModelClass, '{{catalogue_category_to_product}}(product_id, category_id)');
        $relations['info'] = array(self::HAS_ONE, Yii::app()->getModule("catalogue")->productInfoModelClass, 'product_id');
        $relations['propertiesValues'] = array(self::HAS_MANY, 'CataloguePropertyValue', 'product_id');
        $relations['baseCategory'][1] = Yii::app()->getModule("catalogue")->categoryModelClass;

        return $relations;
    }

    public function pivotModels()
    {
        return array(
            'categories' => 'CategoryToProduct',
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
    {
        $behaviors = parent::behaviors();
        $behaviors['activerecord-relation'] = array(
            'class' => 'ext.yiiext.behaviors.activerecord-relation.EActiveRecordRelationBehavior',
        );
        $behaviors['partial-inject'] = array(
            'class' => 'ext.shared-core.form.FormPartialsInjectBehavior',
        );
        return $behaviors;
    }

    /**
     * @return array
     */
    public function formPartialsInject()
    {
        $partials = array("_infoForm");
        if(!$this->isNewRecord) {
            $partials[] = "_properties";
        }
        return $partials;
    }

    /**
     * @param $path
     * @return CActiveRecord
     */
    public function findByPath($path)
    {
        return $this->findByAttributes(array("path" => $path));
    }

    public function attributeLabels() {
        $attributeLabels = parent::attributeLabels();
        $attributeLabels['categories'] = Yii::t('app', 'CatalogueCategories');

        return $attributeLabels;
    }
}