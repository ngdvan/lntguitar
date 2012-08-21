<?php
$this->pageTitle = $classGuitar->title.' - '.Yii::app()->name;
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

function showTitle($data)
{
    if ($data->end_time > time()) {
        echo CHtml::link($data->title, Yii::app()->createUrl("/training/class", array("id" => $data->id))) . "<br/>";
        echo "Đang tuyển sinh";
    } else {
        echo $data->title;
    }

}

function hideEmail($email){
    $tk = substr($email,0,strpos($email,'@'));
    $ext = substr($email,strpos($email,'@'),strlen($email));
    $len = strlen($tk)/2;
    for($i=$len;$i<strlen($tk);$i++)
        $tk[$i]="*";
    return $tk.$ext;
}

function hideTel($tel){
    $av = strlen($tel)/2;
    for($i=$av;$i<strlen($tel);$i++)
        $tel[$i]="*";
    return $tel;
}
echo "<h1 class='title'>Mã số lớp: $classGuitar->sku</h1>";
echo CHtml::openTag("div",array('style'=>'margin-top:12px;'));
echo "<b>".$classGuitar->title."</b> phụ trách bởi Giảng viên <b>".$classGuitar->teacher."</b>. Thời gian khóa học: <u style='color:#5AC9E7'>".date('d/m/Y',$classGuitar->start_time)."</u> đến <u style='color:#5AC9E7'>".date('d/m/Y',$classGuitar->end_time).'</u>'.($classGuitar->end_time > time() ? " ==> ".CHtml::link("Đăng ký ngay",$this->createUrl('register',array('cid'=>$classGuitar->id))) : "");
echo CHtml::closeTag("div");
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'center-grid',
    'dataProvider' => $students,
    'emptyText' => 'Chưa có học viên nào',
    'summaryText' => '',
    //'filter' => $center,
    'columns' => array(
        array(
            'name' => "STT",
            'value' => '$row+1',
        ),
        array(
            'name' => 'name',
            'value' => '$data->name',
            'type' => 'html',
            'htmlOptions' => array(
                'class' => 'ctitle',
            ),
        ),
        array(
            'name' => 'birthday',
            'value' => '$data->birthday',
            'type' => 'html',
            'htmlOptions' => array(
                'class' => 'ctitle',
            ),
        ),

        array(
            'name' => 'create_time',
            'value' => '$data->create_time',
            'type' => 'html',
            'htmlOptions' => array(
                'class' => 'ctitle',
            ),
        ),
        array(
            'name' => 'pay_time',
            'value' => '$data->pay_time',
            'type' => 'html',
            'htmlOptions' => array(
                'class' => 'ctitle',
            ),
        ),
        array(
            'name' => 'tel',
            'value' => 'hideTel($data->tel)',
            'type' => 'html',
            'htmlOptions' => array(
                'class' => 'ctitle',
            ),
        ),
        array(
            'name' => 'email',
            'value' => 'hideEmail($data->email)',
            'type' => 'html',
            'htmlOptions' => array(
                'class' => 'ctitle',
            ),
        ),
    ),
));
if (isset($relatedClass) && $relatedClass):
    echo "<h1 class='title'>Danh sách lớp học lưu</h1>";

    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'center-grid',
        'dataProvider' => $relatedClass,
        'emptyText' => 'Không có lớp học nào',
        'summaryText' => '',
        //'filter' => $center,
        'columns' => array(
            array(
                'name' => "STT",
                'value' => '$data->id',
            ),
            array(
                'name' => 'sku',
                'value' => '$data->sku',
                'type' => 'html',
                'htmlOptions' => array(
                    'class' => 'ctitle',
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
                'name' => CHtml::encode('Đã đăng ký'),
                'value' => '$data->studentCount'
            ),
        ),
    ));
endif;
echo "<h1 class='title'>Địa điểm học</h1>";
echo "<p>Các lớp học khác của trung tâm xem ".CHtml::link("tại đây",$this->createUrl("center",array("id"=>$classGuitar->c->id,'title'=>Lnt::safeTitle($classGuitar->c->title))))."</p>";
echo $classGuitar->c->body;