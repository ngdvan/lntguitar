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
'lyrics',
'embed_code',
array(
			'name' => 't',
			'type' => 'raw',
			'value' => $model->t !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->t)), array('term/view', 'id' => GxActiveRecord::extractPkValue($model->t, true))) : null,
			),
'view',
array(
			'name' => 'ban',
			'type' => 'raw',
			'value' => $model->ban !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->ban)), array('ban/view', 'id' => GxActiveRecord::extractPkValue($model->ban, true))) : null,
			),
array(
			'name' => 'user',
			'type' => 'raw',
			'value' => $model->user !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->user)), array('xfUser/view', 'id' => GxActiveRecord::extractPkValue($model->user, true))) : null,
			),
'create_time',
'update_time',
	),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('rateSongs')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->rateSongs as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('rateSong/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?>