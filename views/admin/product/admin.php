<?php
Yii::import('application.extensions.image.Image');
function getImage($image){
    if($image){
        $thumbImage = new Image(Yii::getPathOfAlias('webroot') . '/' . $image);
        $img_url = $thumbImage->createThumb(110,70);
        return CHtml::image($img_url);
    }
}
$this->breadcrumbs = array(
    'Sản phẩm' => array('admin'),
    Yii::t('app', 'Quản lý'),
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
	$.fn.yiiGridView.update('product-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Quản lý sản phẩm</h1>
<?php /*echo GxHtml::link(Yii::t('app', 'Tìm kiếm nâng cao'), '#', array('class' => 'search-button')); */?><!--
<div class="search-form">
    <?php /*$this->renderPartial('_search', array(
    'model' => $model,
)); */?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'product-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //'id',
        'title',
        'code',
        //'mpn_code',
        array(
            'name'=>'price',
            'value'=>'number_format($data->price,0,",",".")." đ"'
        ),
        array(
            'name'=>'image',
            'value'=>'getImage($data->image)',
            'type'=>'html'
        ),
        /*
          'video',
          'teach_info',
          'body',
          'count_buy',
          */
        array(
            'name' => 'cat_id',
            'value' => 'GxHtml::valueEx($data->cat)',
            'filter' => GxHtml::listDataEx(Term::model()->findAllAttributes(null, true, 'vid=6')),
        ),
        array(
            'name' => 'th_id',
            'value' => 'GxHtml::valueEx($data->th)',
            'filter' => GxHtml::listDataEx(Term::model()->findAllAttributes(null, true, 'vid=7')),
        ),

        array(
            'name'=>'status',
            'value'=> 'GxHtml::valueEx($data->status)',
            'filter'=>array('Ẩn','Hiện','Hết hàng'),
        ),
        array(
            'class' => 'CButtonColumn',
            'template'=>'{update}{delete}',
        ),
    ),
)); ?>