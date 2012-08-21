<?php
$this->breadcrumbs=array(
	'Danh mục',
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);
?>

<h1>Danh mục</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'term-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
        array(
            'name' => 'vid',
            'value' => 'GxHtml::valueEx($data->v)',
            'filter' => GxHtml::listDataEx(Vocabulary::model()->findAllAttributes(null, true)),
        ),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>
