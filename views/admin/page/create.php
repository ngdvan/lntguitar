<?php

$this->breadcrumbs = array(
    'Trang tĩnh' => array('admin'),
    Yii::t('app', 'Đăng trang mới'),
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);
?>

<h1>Đăng trang mới</h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>