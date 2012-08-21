<?php
$this->breadcrumbs = array(
    'Trang tĩnh' => array('admin'),
    Yii::t('app', 'Sửa trang'),
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);
?>

<h1><?php echo 'Sửa: ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>