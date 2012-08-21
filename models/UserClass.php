<?php

Yii::import('application.models._base.BaseUserClass');

class UserClass extends BaseUserClass
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}