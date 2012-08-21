<?php

$this->breadcrumbs = array(
	'Lớp học' => array('admin'),
	Yii::t('app', 'Đăng'),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Lớp học'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'Đăng lớp học'); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>