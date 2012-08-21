<?php
$this->breadcrumbs=array(
	'Danh mục'=>array('admin'),
	'Sửa',
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);
?>

<h1>Sửa <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'listData'=>$listData)); ?>