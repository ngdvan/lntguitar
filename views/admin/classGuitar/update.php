<?php

$this->breadcrumbs = array(
	'Lớp học' => array('admin'),
	Yii::t('app', 'Sửa'),
);

$this->menu = array(
	array('label' => Yii::t('app', 'Đăng') , 'url'=>array('create')),
	array('label' => Yii::t('app', 'Xem') , 'url'=>array('view', 'id' => GxActiveRecord::extractPkValue($model, true))),
	array('label' => Yii::t('app', 'Lớp học'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'Update') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>