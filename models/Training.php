<?php

Yii::import('application.models._base.BaseTraining');

class Training extends BaseTraining
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}