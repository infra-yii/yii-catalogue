<?php

Yii::import('catalogue.models._base.BaseProductInfo');

class ProductInfo extends BaseProductInfo
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}