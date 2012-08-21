<?php

$this->breadcrumbs = array(
    'Tin tức' => array('admin'),
    Yii::t('app', 'Sửa bài'),
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);
?>

<h1><?php echo Yii::t('app', 'Sửa'); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>