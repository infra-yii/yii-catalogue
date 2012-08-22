<?php

/**
 * This is the model base class for the table "{{product}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Product".
 *
 * Columns in table "{{product}}" available as properties of the model,
 * followed by relations of table "{{product}}" available as properties of the model.
 *
 * @property integer $id
 * @property string $title
 * @property string $short_description
 *
 * @property mixed $tblCategories
 * @property CatalogueProductInfo[] $productInfos
 */
abstract class BaseProduct extends GxActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return '{{product}}';
    }

    public static function label($n = 1) {
        return Yii::t('app', 'Product|Products', $n);
    }

    public static function representingColumn() {
        return 'title';
    }

    public function rules() {
        return array(
            array('title, short_description', 'required'),
            array('title', 'length', 'max'=>200),
            array('id, title, short_description', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
            'tblCategories' => array(self::MANY_MANY, 'Category', '{{category_to_product}}(product_id, category_id)'),
            'productInfos' => array(self::HAS_ONE, 'ProductInfo', 'product_id'),
        );
    }

    public function pivotModels() {
        return array(
            'tblCategories' => 'CategoryToProduct',
        );
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'short_description' => Yii::t('app', 'Short Description'),
            'tblCategories' => null,
            'productInfos' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('short_description', $this->short_description, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}