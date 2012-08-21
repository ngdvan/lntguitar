<h1>
    <?php
    /**
     * @var $teacher Teacher
     */
    echo $teacher->name;
    ?>
</h1>
<?php if ($teacher->picture) :    ?>
<div style="float: left;padding: 0px 10px 10px 0px;">
    <?php echo CHtml::image(Lnt::createImage($teacher->picture,400,300),$teacher->name); ?>
</div>
<?php
endif;
?>
<?php
echo CHtml::openTag("div", array('style' => 'text-align:justify'));
echo $teacher->body;
echo CHtml::closeTag("div");
if($teacher->teacherPhotos){
    echo CHtml::openTag("div",array('id'=>'teacher_photo','style'=>'width:670px;clear:both','class'=>'jcarousel-skin-tango'));
    echo CHtml::openTag("ul",array('id'=>'photos'));
    $dir = Yii::getPathOfAlias('webroot') . '/resources/images/245x158';
    if(!is_dir($dir)){
        mkdir($dir);
        chmod($dir, 0755);
    }

    foreach($teacher->teacherPhotos as $photo){
        echo CHtml::openTag('li');
        echo CHtml::image(Lnt::createImage($photo->photo,245,158),$teacher->name,array('class'=>'colorbox1','href'=>Yii::app()->baseUrl.$photo->photo,'height'=>158));
        echo CHtml::closeTag("li");
    }
    echo CHtml::closeTag("ul");
    echo CHtml::closeTag("div");
}

if ($teacher->videos) {
    $videos = new Video('search');
    $videos->teacher_id = $teacher->id;
    $videos->term_id = 10;
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $videos->search(),
        'itemView' => '_view',
        'id' => 'newest_video',
        'enablePagination' => false,
        'summaryText' => 'Bài Giảng',
        //'template' => "{items}\n{pager}",
    ));
}
?>