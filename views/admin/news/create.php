<?php

$this->breadcrumbs = array(
    'Tin tức' => array('admin'),
    Yii::t('app', 'Đăng bài mới'),
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);
?>

<h1><?php echo Yii::t('app', 'Đăng mới'); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>