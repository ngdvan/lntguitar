<?php

Yii::import('application.models._base.BaseStudent');

class Student extends BaseStudent
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function beforeSave(){
        if($this->isNewRecord){
            $this->user_id = Yii::app()->user->id;
            $this->create_time = date('d/m/Y',time());
        }
        return parent::beforeSave();
    }
}