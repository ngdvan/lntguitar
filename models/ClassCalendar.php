<?php

Yii::import('application.models._base.BaseClassCalendar');

class ClassCalendar extends BaseClassCalendar
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}