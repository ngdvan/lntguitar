<?php
$this->breadcrumbs = array(
    'Slide'=>array('admin'),
    'Sửa'
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);
?>

<h1><?php echo 'Sửa: '.$model->title; ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>