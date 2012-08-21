<div id="song-alphabet">
    <?php
    /**
     * @var $this SongController
     */

    for($i=65;$i<=90;$i++){
        if (isset($_GET['tid']))
        {
            $url = array('/song/index',
                'c'=>strtolower(chr($i)),
                'tid'=>$_GET['tid']
            );
        }else{
            $url = array('/song/index',
                'c'=>strtolower(chr($i)),
            );
        }
        $items[] = array(
            'label'=>chr($i),
            'url'=>$url,
            'active'=>(isset($_GET['c']) && $_GET['c'] == strtolower(chr($i))) ? true:false,
        );
    }

        //echo CHtml::link(chr($i),$this->createUrl('index',array('c'=>strtolower(chr($i)))));
    $this->beginWidget('zii.widgets.CMenu');
    $this->widget('zii.widgets.CMenu',array(
        'items'=>$items,
        'activateItems'=>true,
        'itemCssClass'=>'item',
        'activeCssClass'=>'active',
    ));
    $this->endWidget();
    ?>
</div>
<?php
/**
 * @var $dataProvider CActiveDataProvider
 * @var $dataFacility CActiveDataProvider
 */
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'song-grid',
    'dataProvider' => $model->search(),
    //'filter' => $model,
    'summaryText'=>'',
    'columns' => array(
        array(
            'name'=>'title',
            'value'=>'CHtml::link($data->title,array("/song/view","id"=>$data->id,"title"=>Lnt::safeTitle($data->title)));',
            'type'=>'html',
        ),
        //'lyrics',
        //'embed_code',
        /*array(
            'name'=>'tid',
            'value'=>'GxHtml::valueEx($data->t)',
            'filter'=>GxHtml::listDataEx(Term::model()->findAllAttributes(null, true)),
        ),*/
        array(
            'name' => 'ban_id',
            'value' => 'GxHtml::valueEx($data->ban)',
            //'filter' => GxHtml::listDataEx(Ban::model()->findAllAttributes(null, true)),
            'htmlOptions'=>array('width'=>'25%'),
        ),
        array(
            'name' => 'Đánh giá',
            'value' => '$data->getHtmlMark()',
            'htmlOptions'=>array('width'=>'10%'),
            'type'=>'html',
            //'filter' => GxHtml::listDataEx(XfUser::model()->findAllAttributes(null, true)),
        ),
        array(
            'name'=>'view',
            'htmlOptions'=>array('width'=>'10%'),
        )

    ),
));
