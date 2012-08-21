<?php

$this->breadcrumbs = array(
    'Đơn hàng' => array('admin'),
    Yii::t('app', 'Quản lý'),
);

/*$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('order-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Đơn hàng</h1>
<?php /*echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); */?><!--
<div class="search-form">
<?php /*$this->renderPartial('_search', array(
	'model' => $model,
)); */?>
</div>--><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'order-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		'user_id',
		array(
            'name'=>'cost',
            'value'=>'number_format($data->cost,0,",",".")." đ"'
        ),
		'paid',
        array(
            'name'=>'create_time',
            'value'=>'date("d/m/Y",$data->create_time)',
        ),
        array(
            'name'=>'paid_time',
            'value'=>'date("d/m/Y",$data->paid_time)',
        ),
		/*
		'pid',
		'status',
		*/
		array(
			'class' => 'CButtonColumn',
            'template'=>'{delete}',
		),
	),
)); ?>