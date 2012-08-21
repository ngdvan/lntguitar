<?php

$this->breadcrumbs = array(
    'Bản nhạc'=>array('admin'),
    'Quản lý'
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);
?>

<h1>Quản lý bản nhạc</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'song-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		'title',
		//'lyrics',
		//'embed_code',
		array(
				'name'=>'tid',
				'value'=>'GxHtml::valueEx($data->t)',
				'filter'=>GxHtml::listDataEx(Term::model()->findAllAttributes(null, true,'vid=4')),
				),
		'view',

		array(
				'name'=>'ban_id',
				'value'=>'GxHtml::valueEx($data->ban)',
				'filter'=>GxHtml::listDataEx(Ban::model()->findAllAttributes(null, true)),
				),
        /*array(
                  'name'=>'user_id',
                  'value'=>'GxHtml::valueEx($data->user)',
                  'filter'=>GxHtml::listDataEx(XfUser::model()->findAllAttributes(null, true)),
                  ),
          'create_time',
          'update_time',
          */
		array(
			'class' => 'CButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>