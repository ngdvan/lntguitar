<?php

$this->breadcrumbs = array(
	'Ban nhạc/Ca sĩ',
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);

?>

<h1>Ban nhạc và ca sĩ</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'ban-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		'title',
		//'body',
		array(
			'class' => 'CButtonColumn',
            'template'=>'{update},{delete}',
		),
	),
)); ?>