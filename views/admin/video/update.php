<?php

$this->breadcrumbs = array(
	'Quản lý video' => array('admin'),
	Yii::t('app', 'Sửa'),
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);
?>

<h1><?php echo Yii::t('app', 'Sửa: ') .' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>