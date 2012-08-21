<?php

$this->breadcrumbs = array(
	"Hợp âm",
);

$this->menu=array(
    array('label'=>'Danh sách', 'url'=>array('admin')),
    array('label'=>'Tạo mới', 'url'=>array('create')),
);


?>

<h1><?php echo "Quản lý hợp âm"; ?></h1>


<?php
function getLyricLink($hopam){
    return CHtml::link("Download",Yii::app()->createUrl('hopam/download',array('path'=>$hopam->lyrics)));
}

$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'hopam-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		array(
            'name'=>'id',
            'htmlOptions'=>array(
                'width'=>'5%',
            )
        ),
		'title',
		array(
            'name'=>'lyrics',
            'value'=>'getLyricLink($data)',
            'type'=>'html',
            'htmlOptions'=>array(
                'width'=>'5%',
            ),
            'filter'=>false,
        ),
		//'embed_code',
		array(
				'name'=>'tid',
				'value'=>'GxHtml::valueEx($data->t)',
				'filter'=>GxHtml::listDataEx(Term::model()->findAllAttributes(null, true,'vid=3')),
				),
		array(
            'name'=>'view',
            'htmlOptions'=>array(
                'width'=>'10%',
            )
        ),

		array(
				'name'=>'ban_artist',
				),
        //'guider',
        /*
          array(
                  'name'=>'user_id',
                  'value'=>'GxHtml::valueEx($data->user)',
                  'filter'=>GxHtml::listDataEx(XfUser::model()->findAllAttributes(null, true)),
                  ),

          'create_time',
          'tags',
          'update_time',
          'status',
          */
		array(
			'class' => 'CButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>