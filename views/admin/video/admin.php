<?php

$this->breadcrumbs = array(
    Yii::t('app', 'Quản lý video'),
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('video-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Quản lý Video'); ?></h1>
<!--
<?php /*echo GxHtml::link(Yii::t('app', 'Tìm kiếm'), '#', array('class' => 'search-button')); */?>
<div class="search-form">
<?php /*$this->renderPartial('_search', array(
	'model' => $model,
)); */?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'video-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'title',
        'link_youtube',
        array(
            'name' => 'term_id',
            'value' => 'GxHtml::valueEx($data->term)',
            'filter' => GxHtml::listDataEx(Term::model()->findAllAttributes(null, true, 'vid=2')),
        ),

        array(
            'name' => 'teacher_id',
            'value' => 'GxHtml::valueEx($data->teacher)',
            'filter' => GxHtml::listDataEx(Teacher::model()->findAllAttributes(null, true)),
        ),
        /*
		'create_time',
		'update_time',
		'status',
		*/
        array(
            'class' => 'CButtonColumn',
            'template'=>'{update},{delete}',
        ),
    ),
)); ?>