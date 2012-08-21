<?php
Yii::import('zii.widgets.CPortlet');
class NewestHopam extends CPortlet
{

    public function init()
    {
        $this->id = 'newest_song';
        parent::init();
    }

    protected function renderContent()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('status=1');
        $criteria->order = 'create_time DESC';
        $criteria->limit = 20;
        $hopam = Hopam::model()->findAll($criteria);
        /*$dataProvider = new CActiveDataProvider('Song', array(
            'pagination' => array(
                'pageSize' => Yii::app()->params['postsPerPage'],
            ),
            'criteria' => $criteria,
        ));
        $this->render('newest_song',array('songs'=>$dataProvider));*/
        echo CHtml::openTag("div",array('class'=>'title'));
        echo "Hợp Âm Mới";
        echo CHtml::closeTag("div");
        if($hopam){
            echo CHtml::openTag("ul");
            foreach($hopam as $hp){
                echo CHtml::openTag('li');
                echo CHtml::link($hp->title,array('/hopam/view','id'=>$hp->id,"title"=>Lnt::safeTitle($hp->title)))." <span style='color:#a7a7a7'>($hp->view)</span>";
                echo CHtml::closeTag('li');
            }
            echo CHtml::closeTag("ul");
        }
    }
}