<?php

Yii::import('application.models._base.BasePage');

class Page extends BasePage
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function beforeSave(){
        if($this->isNewRecord){
            $this->create_time = $this->update_time = time();
            $this->user_id = Yii::app()->user->id;
        }else{
            $this->update_time = time();
        }
        return parent::beforeSave();
    }
}