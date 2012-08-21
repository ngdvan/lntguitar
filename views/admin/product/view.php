<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
'title',
'code',
'mpn_code',
'price',
'video',
'teach_info',
'body',
array(
			'name' => 'cat',
			'type' => 'raw',
			'value' => $model->cat !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->cat)), array('term/view', 'id' => GxActiveRecord::extractPkValue($model->cat, true))) : null,
			),
array(
			'name' => 'th',
			'type' => 'raw',
			'value' => $model->th !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->th)), array('term/view', 'id' => GxActiveRecord::extractPkValue($model->th, true))) : null,
			),
'count_buy',
'status',
	),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('productImages')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->productImages as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('productImage/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?>