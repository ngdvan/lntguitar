<?php

Yii::import('application.models._base.BaseVideoComment');

class VideoComment extends BaseVideoComment
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