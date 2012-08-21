<?php
/**
 * @var $dataProvider CActiveDataProvider
 * @var $dataFacility CActiveDataProvider
 * @var $this TrainingController
 */
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'id' => 'newest_video',
    'enablePagination'=>false,
    'summaryText'=> $title,
    //'template' => "{items}\n{pager}",
));

