<?php

Yii::import('application.models._base.BaseProduct');

class Product extends BaseProduct
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}