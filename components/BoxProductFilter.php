<?php
/**
 * User: thanhdx
 * Date: 6/1/12
 * Time: 1:05 AM
 * @file BoxTeacher.php
 */
Yii::import('zii.widgets.CPortlet');
class BoxProductFilter extends CPortlet
{
    public $htmlOptions=array('class'=>'clearfix');
    public $contentCssClass='box_teacher_inner clearfix';
    public function init()
    {
        $this->id = 'box_teacher';
        parent::init();
    }

    public function renderContent()
    {
        $criteria = new CDbCriteria(array(
            'condition' => 'status=1',
            'order' => 'id DESC',
            'limit' => '10',
        ));
        $teachers = Teacher::model()->findAll($criteria);
        if ($teachers) {
            echo CHtml::openTag("ul");
            foreach ($teachers as $teacher) {
                if ($teacher->picture) {
                    Yii::import('application.extensions.image.Image');
                    $thumbImage = new Image(Yii::getPathOfAlias('webroot') . $teacher->picture);
                    $img_url = $thumbImage->createThumb(70,60);
                    /*$thumbImage->resize(70, 60, Image::WIDTH);
                    $arr = explode("/",$teacher->picture);
                    $file_name = $arr[count($arr)-1];
                    $thumb = Yii::getPathOfAlias('webroot') . '/resources/images/85x72/' . $file_name;
                    $thumbImage->save($thumb);*/
                    $img = '<img src="'.$img_url.'" />';
                }
                echo CHtml::openTag("li",array('class'=>'clearfix'));
                echo CHtml::openTag("div",array('class'=>'avatar'));
                echo CHtml::link($img,Yii::app()->createUrl('/teacher/view',array('id'=>$teacher->id)));
                echo "<div>Giảng viên</div>";
                echo CHtml::closeTag("div");
                echo CHtml::openTag("div",array('class'=>'title'));
                echo CHtml::link($teacher->name,Yii::app()->createUrl('/teacher/view',array('id'=>$teacher->id)));
                echo CHtml::closeTag("div");
                echo CHtml::openTag("div",array('style'=>'margin-top:10px;float:left;width:80px;height:14px;background:#ce1f46;color:#fff;padding:8px 0px;text-align:center'));
                echo "5.1232";
                echo CHtml::closeTag("div");
                echo CHtml::openTag("div",array('style'=>'float:right;text-align:left;width:127px;margin-top:10px;font-weight:bold;color:#a8a8a8;'));
                echo $teacher->videoCount." bài giảng | ".$teacher->likeTeachersCount." ".CHtml::ajaxLink(CHtml::image(Yii::app()->baseUrl.'/images/tim_03.jpg'), Yii::app()->createUrl('/teacher/like', array('id' => $teacher->id)), array('success' => 'js:function(res){alert(res.msg);}'), array('class' => 'teacher_like')); ;
                echo CHtml::closeTag("div");
                echo CHtml::closeTag("li");
            }
            echo CHtml::closeTag("ul");
        }
    }
}
