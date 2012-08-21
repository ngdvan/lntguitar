<?php

$this->breadcrumbs = array(
    'Slide'=>array('admin'),
    'Quản lý'
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);
Yii::import('application.extensions.image.Image');
function showImage($model){
    if (isset($model->image) && $model->image){
        $thumbImage = new Image(Yii::getPathOfAlias('webroot') . '/' . $model->image);
        $img_url = $thumbImage->createThumb(110, 70);
        echo CHtml::image($img_url);
    }
}
?>

<h1>Quản lý slide ảnh</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'slide-manager-grid',
	'dataProvider' => $model->search(),
	//'filter' => $model,
	'columns' => array(
		'id',
		'title',
		'url',
		array(
            'name'=>'image',
            'value'=>'showImage($data)',
            'type'=>'html',
        ),
		'pos',
		//'status',
		array(
			'class' => 'CButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>