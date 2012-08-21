<?php

$this->breadcrumbs = array(
    'Loại khóa học' => array('admin'),
    Yii::t('app', 'Quản lý'),
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);
/*
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('training-grid', {
		data: $(this).serialize()
	});
	return false;
});
");*/
?>

<h1>Loại khóa học</h1>
<?php /*echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); */?><!--
<div class="search-form">
<?php /*$this->renderPartial('_search', array(
	'model' => $model,
)); */?>
</div>--><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'training-grid',
	'dataProvider' => $model->search(),
	//'filter' => $model,
	'columns' => array(
		//'id',
		'title',
		//'body',
		//'status',
		array(
			'class' => 'CButtonColumn',
            'template'=>'{update},{delete}',
		),
	),
)); ?>