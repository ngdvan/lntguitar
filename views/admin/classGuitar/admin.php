<?php

$this->breadcrumbs = array(
    'Lớp học' => array('admin'),
    'Quản lý'
);

$this->menu = array(
    array('label' => 'Danh sách', 'url' => array('admin')),
    array('label' => 'Tạo mới', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('class-guitar-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Các lớp học</h1>
<?php echo GxHtml::link(Yii::t('app', 'Tìm kiếm'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
    <?php $this->renderPartial('_search', array(
    'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'class-guitar-grid',
    'dataProvider' => $model->search(),
    //'filter' => $model,
    'columns' => array(
        'sku',
        'title',
        // 'body',
        array(
            'name' => 'tid',
            'value' => 'GxHtml::valueEx($data->t)',
            'filter' => GxHtml::listDataEx(Training::model()->findAllAttributes(null, true)),
        ),
        array(
            'name' => 'cid',
            'value' => 'GxHtml::valueEx($data->c)',
            'filter' => GxHtml::listDataEx(Center::model()->findAllAttributes(null, true)),
        ),
        array(
            'name' => 'start_time',
            'value' => 'date("d/m/Y",$data->start_time)'
        ), array(
            'name' => 'end_time',
            'value' => 'date("d/m/Y",$data->end_time)'
        ),
        /*
          'start_time',
          'create_time',
          'update_time',
          */
        array(
            'class' => 'CButtonColumn',
        ),
    ),
)); ?>