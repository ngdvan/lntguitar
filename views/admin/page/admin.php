<?php

$this->breadcrumbs = array(
    'Trang tĩnh' => array('admin'),
    Yii::t('app', 'Quản lý'),
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);

/*Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('page-grid', {
		data: $(this).serialize()
	});
	return false;
});
");*/
?>

<h1>Trang tĩnh</h1>
<!--
<?php /*echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); */?>
<div class="search-form">
<?php /*$this->renderPartial('_search', array(
	'model' => $model,
)); */?>
</div>--><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'page-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		//'id',

        array(
            'name'=>'title',
            'value'=>'CHtml::link($data->title,Yii::app()->baseUrl."/page/".Lnt::safeTitle($data->title)."-".$data->id.".html")',
            'type'=>'html',
        ),
		//'body',
		//'status',
		array(
				'name'=>'user_id',
				'value'=>'GxHtml::valueEx($data->user)',
				'filter'=>GxHtml::listDataEx(XfUser::model()->findAllAttributes(null, true)),
				),
        array(
            'name'=>'create_time',
            'value'=>'date("d/m/Y",$data->create_time)',
        ),

		/*
		'update_time',
		*/
		array(
			'class' => 'CButtonColumn',
            'template'=>'{update},{delete}',
		),
	),
)); ?>