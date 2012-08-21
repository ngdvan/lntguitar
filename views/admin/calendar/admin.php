<?php

$this->breadcrumbs = array(
	'TKB' => array('admin'),
);

$this->menu = array(
		array('label'=>Yii::t('app', 'Tạo mới TKB'), 'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('class-calendar-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Thời khóa biểu</h1>

<?php
function getDay($day){
    $days = array(1=>'Chủ nhật',2=>'Thứ hai',3=>'Thứ ba',4=>'Thứ tư',5=>'Thứ năm',6=>'Thứ sáu',7=>'Thứ bảy');
    return $days[$day];
}
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'class-calendar-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		array(
            'name'=>'day',
            'value'=>'getDay($data->day)',
        ),
		array(
            'name'=>'start_time',
            'value'=>'date("H:i",$data->start_time)'
        ),
        array(
            'name'=>'end_time',
            'value'=>'date("H:i",$data->end_time)'
        ),
		array(
				'name'=>'class_id',
				'value'=>'GxHtml::valueEx($data->class)',
				'filter'=>GxHtml::listDataEx(ClassGuitar::model()->findAllAttributes(null, true)),
				),
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>