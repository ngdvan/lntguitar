<?php

Yii::import('application.models._base.BaseHopamComment');

class HopamComment extends BaseHopamComment
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function beforeSave(){
        if($this->isNewRecord){
            $this->create_time = time();
        }

        return parent::beforeSave();
    }
}