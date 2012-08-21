<?php
Yii::import('zii.widgets.CPortlet');
class NewestSong extends CPortlet
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
        $songs = Song::model()->findAll($criteria);
        /*$dataProvider = new CActiveDataProvider('Song', array(
            'pagination' => array(
                'pageSize' => Yii::app()->params['postsPerPage'],
            ),
            'criteria' => $criteria,
        ));
        $this->render('newest_song',array('songs'=>$dataProvider));*/
        echo CHtml::openTag("div",array('class'=>'title'));
        echo "Bản nhạc mới";
        echo CHtml::closeTag("div");
        if($songs){
            echo CHtml::openTag("ul");
            foreach($songs as $song){
                echo CHtml::openTag('li');
                echo CHtml::link($song->title,array('/song/view','id'=>$song->id,"title"=>Lnt::safeTitle($song->title)))." <span style='color:#a7a7a7'>($song->view)</span>";
                echo CHtml::closeTag('li');
            }
            echo CHtml::closeTag("ul");
        }
    }
}