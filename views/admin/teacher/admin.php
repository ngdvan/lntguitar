<?php
$this->breadcrumbs = array(
	'Giáo viên',
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);
Yii::import('application.extensions.image.Image');
function getImage($image){
    $img = Yii::getPathOfAlias('webroot') . '/' . $image;
    if(file_exists($img)&& is_file($img)){
        //var_dump($img);die;
        $thumbImage = new Image($img);
        $img_url = $thumbImage->createThumb(110,70);
        echo CHtml::image($img_url);
    }
    //var_dump($img);
}
?>

<h1>Quản lý giáo viên</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'teacher-grid',
	'dataProvider' => $model->search(),
	//'filter' => $model,
	'columns' => array(
		'id',
		'name',
		//'body',
		array(
            'name'=>'picture',
            'value'=>'getImage($data->picture)',
            'type'=>'html'
        ),
		//'status',
		'pos',
		'likeTeachersCount',
		array(
			'class' => 'CButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>