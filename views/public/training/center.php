<?php
$this->pageTitle = $center->title.' - '.Yii::app()->name;
function calendar($items)
{
    if ($items) {
        $thu = array(1 => 'Chủ nhật', 2 => 'Thứ hai', 3 => 'Thứ ba', 4 => 'Thứ tư', 5 => 'Thứ năm', 6 => 'Thứ sáu', 7 => 'Thứ bảy');
        echo CHtml::openTag("ul");
        foreach ($items as $item) {
            echo CHtml::openTag("li");
            echo $thu[$item->day] . ": " . date("H:i", $item->start_time) . " - " . date("H:i", $item->end_time);
            echo CHtml::closeTag("li");
        }
        echo CHtml::closeTag("ul");
    }
}

function showTitle($data){
    if($data->end_time > time()){
        echo CHtml::link($data->title,Yii::app()->createUrl("/training/class",array("id"=>$data->id,"title"=>Lnt::safeTitle($data->title))))."<br/>";
        echo "Đang tuyển sinh";
    }else{
        echo $data->title;
    }

}

echo "<h1 class='title'>$center->title</h1>";
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'center-grid',
    'dataProvider' => $dataProvider,
    'emptyText'=>'Không có lớp học nào',
    'summaryText'=>'',
    //'filter' => $center,
    'columns' => array(
        array(
            'name' => "STT",
            'value' => '$row+1',
        ),
        array(
            'name'=>'sku',
            'value'=>'$data->sku',
            'type'=>'html',
            'htmlOptions'=>array(
                'class'=>'ctitle',
            ),
        ),
        array(
            'name' => 'title',
            'value' => 'showTitle($data)',
            'type' => 'html',
            //'htmlOptions'=>array('valign'=>'top','style'=>'vertical-align: top;'),
        ),
        array(
            'name' => 'Lịch học',
            'value' => 'calendar($data->classCalendars)',
        ),
        'teacher',
        array(
            'name'=>CHtml::encode('Đã đăng ký'),
            'value'=>'$data->studentCount."/".$data->max'
        ),
    ),
));

echo "<h1 class='title'>Danh sách lớp học lưu</h1>";

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'center-grid',
    'dataProvider' => $dataProvider2,
    'emptyText'=>'Không có lớp học nào',
    'summaryText'=>'',
    //'filter' => $center,
    'columns' => array(
        array(
            'name' => "STT",
            'value' => '$row+1',
        ),
        array(
            'name'=>'sku',
            'value'=>'$data->sku',
            'type'=>'html',
            'htmlOptions'=>array(
                'class'=>'ctitle',
            ),
        ),
        array(
            'name' => 'title',
            'value' => 'showTitle($data)',
            'type' => 'html',
            //'htmlOptions'=>array('valign'=>'top','style'=>'vertical-align: top;'),
        ),
        array(
            'name' => 'Lịch học',
            'value' => 'calendar($data->classCalendars)',
        ),
        'teacher',
        array(
            'name'=>CHtml::encode('Đã đăng ký'),
            'value'=>'$data->studentCount'
        ),
    ),
));
echo "<h1 class='title'>Thông tin trung tâm</h1>";
echo $center->body;