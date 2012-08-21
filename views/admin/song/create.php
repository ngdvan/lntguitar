<?php

$this->breadcrumbs = array(
    'Bản nhạc' => array('admin'),
	Yii::t('app', 'Tạo mới'),
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);
?>

<h1><?php echo 'Tạo mới '; ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>