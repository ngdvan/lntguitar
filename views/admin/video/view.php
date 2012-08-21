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
'body',
'link_youtube',
'file_path',
array(
			'name' => 'term',
			'type' => 'raw',
			'value' => $model->term !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->term)), array('term/view', 'id' => GxActiveRecord::extractPkValue($model->term, true))) : null,
			),
array(
			'name' => 'teacher',
			'type' => 'raw',
			'value' => $model->teacher !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->teacher)), array('teacher/view', 'id' => GxActiveRecord::extractPkValue($model->teacher, true))) : null,
			),
'create_time',
'update_time',
'status',
	),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('likeVideos')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->likeVideos as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('likeVideo/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('videoComments')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->videoComments as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('videoComment/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?>