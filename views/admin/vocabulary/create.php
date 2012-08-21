<?php
$this->breadcrumbs=array(
	'Loại danh mục'=>array('admin'),
	'Tạo mới',
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);
?>

<h1>Tạo mới loại danh mục</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>