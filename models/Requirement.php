<?php

Yii::import('application.models._base.BaseRequirement');

class Requirement extends BaseRequirement
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}