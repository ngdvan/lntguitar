<?php

Yii::import('application.models._base.BaseVocabulary');

class Vocabulary extends BaseVocabulary
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}