<?php

$this->breadcrumbs = array(
    'Lớp học' => array('admin'),
    GxHtml::valueEx($model),
);

$this->menu = array(
    array('label' => Yii::t('app', 'Đăng'), 'url' => array('create')),
    array('label' => Yii::t('app', 'Sửa'), 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('app', 'Xóa'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => Yii::t('app', 'Lớp học'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'Lớp học: '). ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'title',
        'body',
        'status',
        array(
            'name' => 't',
            'type' => 'raw',
            'value' => $model->t !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->t)), array('training/view', 'id' => GxActiveRecord::extractPkValue($model->t, true))) : null,
        ),
        array(
            'name' => 'c',
            'type' => 'raw',
            'value' => $model->c !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->c)), array('center/view', 'id' => GxActiveRecord::extractPkValue($model->c, true))) : null,
        ),
        array(
            'name' => 'start_time',
            'value' => date("d/m/Y", $model->start_time),
        ),
        array(
            'name' => 'end_time',
            'value' => date("d/m/Y", $model->end_time),
        ),
    ),
));

function getDay($day)
{
    $days = array(1 => 'Chủ nhật', 2 => 'Thứ hai', 3 => 'Thứ ba', 4 => 'Thứ tư', 5 => 'Thứ năm', 6 => 'Thứ sáu', 7 => 'Thứ bảy');
    return $days[$day];
}

?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('classCalendars')); ?></h2>
<?php
echo GxHtml::openTag('ul');
foreach ($model->classCalendars as $relatedModel) {
    echo GxHtml::openTag('li');
    echo GxHtml::encode(getDay(GxHtml::valueEx($relatedModel))) . " ";
    echo GxHtml::encode(date("H:i", $relatedModel->start_time)) . " - ";
    echo GxHtml::encode(date("H:i", $relatedModel->end_time)) . "<br/>";
    echo GxHtml::closeTag('li');
}
echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('userClasses')); ?></h2>
<?php
echo GxHtml::openTag('ul');
foreach ($model->userClasses as $relatedModel) {
    echo GxHtml::openTag('li');
    echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('userClass/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
    echo GxHtml::closeTag('li');
}
echo GxHtml::closeTag('ul');
?>