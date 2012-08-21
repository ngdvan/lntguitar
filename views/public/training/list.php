<?php $this->pageTitle = $title . ' - ' . Yii::app()->name . ""; ?>
<img src="<?php echo Yii::app()->baseUrl; ?>/images/khoahoc_03.jpg" usemap="#loaikhoahoc"/>
<map name="loaikhoahoc">
    <area shape="rect" coords="137,53,233,211"
          href="<?php echo $this->createUrl('/training/list', array('tid' => 1)) ?>" alt="Sun"/>
    <area shape="rect" coords="254,53,354,211"
          href="<?php echo $this->createUrl('/training/list', array('tid' => 2)) ?>" alt="Mercury"/>
    <area shape="rect" coords="438,53,533,211"
          href="<?php echo $this->createUrl('/training/list', array('tid' => 3)) ?>" alt="Venus"/>
    <area shape="rect" coords="560,53,656,211"
          href="<?php echo $this->createUrl('/training/list', array('tid' => 4)) ?>" alt="Venus"/>
    <area shape="rect" coords="682,53,778,211"
          href="<?php echo $this->createUrl('/training/list', array('tid' => 5)) ?>" alt="Venus"/>
</map>
<?php
function renderList($items)
{
    if ($items) {
        echo CHtml::openTag("ul");
        foreach ($items as $item) {
            echo CHtml::openTag("li");
            echo CHtml::link($item->title, Yii::app()->createUrl('/training/class', array('id' => $item->id)));
            echo CHtml::closeTag("li");
        }
        echo CHtml::closeTag("ul");
    }
}

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

echo "<h1 class='title' style='margin-top: 20px;'>$title</h1>";
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'center-grid',
    'dataProvider' => $items,
    'summaryText' => '',
    //'filter' => $center,
    'columns' => array(
        'sku',
        array(
            'name' => 'title',
            'value' => 'CHtml::link($data->title,Yii::app()->createUrl("/training/class",array("id"=>$data->id,"title"=>Lnt::safeTitle($data->title))),array("class"=>"ctitle"))',
            'type' => 'html'
        ),
        array(
            'name' => 'c',
            'value' => 'CHtml::link($data->c->title,Yii::app()->createUrl("/training/center",array("id"=>$data->c->id,"title"=>Lnt::safeTitle($data->c->title))),array("class"=>"ctitle"))',
            'type' => 'html'
        )
    ,
        array(
            'name' => 'Lịch học',
            'value' => 'calendar($data->classCalendars)',
        ),
        'teacher',
        array(
            'name' => CHtml::encode('Đã đăng ký'),
            'value' => '$data->studentCount."/".$data->max'
        ),

    ),
));
?>
