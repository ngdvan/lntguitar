<?php

$this->breadcrumbs = array(
	'Trung tâm',
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);


?>

<h1><?php echo Yii::t('app', 'Các trung tâm LNT'); ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'center-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		//'id',
		'title',
		'body:html',
		//'province_id',
		//'district_id',
		array(
			'class' => 'CButtonColumn',
            'template'=>"{update}{delete}"
		),
	),
)); ?>