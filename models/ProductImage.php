<?php

Yii::import('application.models._base.BaseProductImage');

class ProductImage extends BaseProductImage
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}