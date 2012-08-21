<?php
$this->breadcrumbs = array(
    'Menu' => array('admin'),
    Yii::t('app', 'Quản lý'),
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);
?>

<h1>Quản lý menu</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'menu-items-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		'sort',
		'parent',
		'title',
		'router',
		'url',
		/*
		'is_backend',
		*/
		array(
			'class' => 'CButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>