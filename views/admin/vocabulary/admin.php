<?php
$this->breadcrumbs=array(
	'Loại danh mục',
);

$this->menu=array(
	array('label'=>'Danh sách', 'url'=>array('admin')),
	array('label'=>'Tạo mới', 'url'=>array('create')),
);
?>

<h1>Loại danh mục</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'vocabulary-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>
