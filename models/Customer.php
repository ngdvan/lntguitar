<?php

Yii::import('application.models._base.BaseCustomer');

class Customer extends BaseCustomer
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
    public function beforeSave(){
        if($this->isNewRecord){
            $this->user_id = Yii::app()->user->id;
        }
        return parent::beforeSave();
    }
}