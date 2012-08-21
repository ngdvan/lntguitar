<?php
/*$this->breadcrumbs=array(
    $model->title,
);*/
$this->pageTitle = Yii::app()->name . " - Video bài giảng";
?>
<div class="span-17">
    <?php
    /**
     * @var $dataProvider CActiveDataProvider
     * @var $dataFacility CActiveDataProvider
     * @var $this TrainingController
     */
    Yii::import('application.extensions.image.Image');
    ?>
    <h1 class="title"><?php echo $title ?></a></h1>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $items,
        'itemsTagName' => 'ul',
        'itemsCssClass' => 'banchay clearfix',
        'itemView' => '_view',
//    'id' => 'newest_video',
        'enablePagination' => true,
        'summaryText' => "",
        //'template' => "{items}\n{pager}",
    ));
    ?>
    <script type="text/javascript">
        $('ul.banchay').find('li').first().addClass('first');
    </script>
</div>
<div class="span-6 last">
    <?php if (isset($thItems) && $thItems): ?>
    <h1>Thể loại</h1>
    <div class="theloai">
        <?php foreach ($thItems as $thItem): ?>
        <p>
            <?php
            echo CHtml::checkBox("th_" . $thItem['value'], $thItem['checked'], array('value' => $thItem['value']));
            echo CHtml::label($thItem['title'], 'th_' . $thItem['value']);
            ?>
        </p>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if (isset($catItems) && $catItems): ?>
    <h1 style="margin-top: 20px">Phân loại</h1>
    <ul class="catbox">
        <?php foreach ($catItems as $thItem): ?>
        <li>
            <?php
            echo CHtml::link($thItem['title'], $this->createUrl('/product/list', array('catid' => $thItem['value'],'title'=>Lnt::safeTitle($thItem['title']))));
            ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>
<script type="text/javascript">
    $('.theloai').find('p').last().css('border', 'none');
</script>