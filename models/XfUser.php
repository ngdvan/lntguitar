<?php

Yii::import('application.models._base.BaseXfUser');

class XfUser extends BaseXfUser
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}