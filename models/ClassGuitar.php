<?php

Yii::import('application.models._base.BaseClassGuitar');

class ClassGuitar extends BaseClassGuitar
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}