<?php
/*$this->breadcrumbs=array(
    $model->title,
);*/
$this->pageTitle = 'Video bài giảng - '.Yii::app()->name."";
?>
<?php
/**
 * @var $dataProvider CActiveDataProvider
 * @var $dataFacility CActiveDataProvider
 * @var $this TrainingController
 */
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'id' => 'newest_video',
    'enablePagination'=>false,
    'summaryText'=>'Video Mới',
    //'template' => "{items}\n{pager}",
));
?>
<div id="top_view_like">
    <div id="title">
        <div id="tab1" class="arrow_left_active">Xem nhiều nhất</div>
        <div id="tab2" class="arrow_left">Bình chọn nhiều nhất</div>
    </div>
    <div id="c_tab1">
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider2,
            'itemView' => '_view',
            'id' => 'topview_video',
            'enablePagination'=>false,
            'summaryText'=>'',
            //'template' => "{items}\n{pager}",
        ));

        ?>
    </div>
    <div id="c_tab2" style="display: none;">
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider3,
            'itemView' => '_view',
            'id' => 'topview_video',
            'enablePagination'=>false,
            'summaryText'=>'',
            //'template' => "{items}\n{pager}",
        ));

        ?>
    </div>
</div>
