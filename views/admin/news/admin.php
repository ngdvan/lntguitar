<?php

$this->breadcrumbs = array(
	'Tin tức' => array('admin'),
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
	$.fn.yiiGridView.update('news-grid', {
		data: $(this).serialize()
	});
	return false;
});
");*/
?>

<h1>Tin tức</h1>
<?php /*echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); */?><!--
<div class="search-form">
<?php /*$this->renderPartial('_search', array(
	'model' => $model,
)); */?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'news-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		//'id',
		'title',
		//'body',
		array(
            'name'=>'create_time',
            'value'=>'date("d/m/Y",$data->create_time)',
        ),
		//'update_time',
		array(
				'name'=>'user_id',
				'value'=>'GxHtml::valueEx($data->user)',
				'filter'=>GxHtml::listDataEx(XfUser::model()->findAllAttributes(null, true)),
				),
		/*
		array(
				'name'=>'term_id',
				'value'=>'GxHtml::valueEx($data->term)',
				'filter'=>GxHtml::listDataEx(Term::model()->findAllAttributes(null, true)),
				),
		array(
					'name' => 'status',
					'value' => '($data->status === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		*/
		array(
			'class' => 'CButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>