<?php

Yii::import('catalogue.models._base.BaseCatalogueCategory');

/**
 * @property CatalogueProperty[] properties
 * @property CatalogueProduct[] products
 */
class CatalogueCategory extends BaseCatalogueCategory implements IFormPartialsInject
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
        unset ($relations['catalogueCategories']);

        $relations['products'] = array(self::MANY_MANY, Yii::app()->getModule("catalogue")->productModelClass, '{{catalogue_category_to_product}}(product_id, category_id)');
        $relations['info'] = array(self::HAS_ONE, Yii::app()->getModule("catalogue")->categoryInfoModelClass, 'category_id');
        $relations['properties'] = array(self::MANY_MANY, 'CatalogueProperty', '{{catalogue_property_to_category}}(category_id, property_id)');
        $relations['subCategories'] = array(self::HAS_MANY, 'CatalogueCategory', 'parent_id');

        return $relations;
    }

    /**
     * @param bool $onlyInherited
     * @return CatalogueProperty[]
     */
    public function collectProperties($onlyInherited = false) {
        $props = $onlyInherited ? array() : $this->properties;
        if(!$this->parent) return $props;
        foreach($this->parent->collectProperties() as $prop) {
            $props[] = $prop;
        }
        return $props;
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

    public function subCategories($modelCategory){
        $categories = array();

        foreach($modelCategory->subCategories as $category){
            $categories[] = $category;
            foreach($this->subCategories($category) as $subSubCat){
                $categories[] = $subSubCat;
            }
        }

        return $categories;
    }
    public function getBranch(){
        $branch = $this->parent ? $this->parent->getBranch() : array();
        $branch[] = $this;
        return $branch;
    }
    /**
     * @return array
     */
    public function formPartialsInject()
    {
        return array(
            "_infoForm",
            "_properties"
        );
    }
}