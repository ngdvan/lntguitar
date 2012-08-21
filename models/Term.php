<?php

Yii::import('application.models._base.BaseTerm');

class Term extends BaseTerm
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}