<?php
$this->breadcrumbs = array(
    'Slide'=>array('admin'),
    'Tạo mới'
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);
?>

<h1>Thêm ảnh vào slide</h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>