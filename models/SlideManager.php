<?php

Yii::import('application.models._base.BaseSlideManager');

class SlideManager extends BaseSlideManager
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}