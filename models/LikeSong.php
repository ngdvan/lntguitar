<?php

Yii::import('application.models._base.BaseLikeSong');

class LikeSong extends BaseLikeSong
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}