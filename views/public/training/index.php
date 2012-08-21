<?php $this->pageTitle = 'Khóa học guitar - ' . Yii::app()->name . ""; ?>
<img src="<?php echo Yii::app()->baseUrl; ?>/images/khoahoc_03.jpg" usemap="#loaikhoahoc"/>
<map name="loaikhoahoc">
    <area shape="rect" coords="137,53,233,211"
          href="<?php echo $this->createUrl('/training/list', array('tid' => 1)) ?>" alt="Sun"/>
    <area shape="rect" coords="254,53,354,211"
          href="<?php echo $this->createUrl('/training/list', array('tid' => 2)) ?>" alt="Mercury"/>
    <area shape="rect" coords="438,53,533,211"
          href="<?php echo $this->createUrl('/training/list', array('tid' => 3)) ?>" alt="Venus"/>
    <area shape="rect" coords="560,53,656,211"
          href="<?php echo $this->createUrl('/training/list', array('tid' => 4)) ?>" alt="Venus"/>
    <area shape="rect" coords="682,53,778,211"
          href="<?php echo $this->createUrl('/training/list', array('tid' => 5)) ?>" alt="Venus"/>
</map>
<?php
function renderList($items)
{
    if ($items) {
        echo CHtml::openTag("ul");
        foreach ($items as $item) {
            echo CHtml::openTag("li");
            if ($item->end_time > time())
                echo CHtml::link($item->title, Yii::app()->createUrl('/training/class', array('id' => $item->id, 'title' => Lnt::safeTitle($item->title))));
            else
                echo $item->title;
            echo CHtml::closeTag("li");
        }
        echo CHtml::closeTag("ul");
    }
}

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'center-grid',
    'dataProvider' => $center->search(),
    //'filter' => $center,
    'summaryText' => '',
    'columns' => array(
        'id',
        array(
            'name' => 'title',
            'value' => 'CHtml::link($data->title,Yii::app()->createUrl("/training/center",array("id"=>$data->id,"title"=>Lnt::safeTitle($data->title))),array("class"=>"ctitle"))',
            'type' => 'html'
        ),
        'body:html',
        array(
            'name' => 'Lớp đang tuyển',
            'value' => 'renderList($data->classGuitars)',
            //'filter' => GxHtml::listDataEx($data->classGuitars),
        ),

    ),
));
?>
<!-- <?php
/*if($center):
*/?>
<table>
    <thead>
    <tr>
        <th>STT</th>
        <th>Tên cơ sở</th>
        <th>Địa chỉ</th>
        <th>Đang tuyển</th>
    </tr>
    </thead>
    <tbody>
    <?php /*foreach($center as $key=>$c): */?>
    <tr>
        <td><?php /*echo $key+1; */?></td>
        <td><?php /*echo $c->title; */?></td>
        <td><?php /*echo $c->body; */?></td>
        <td><?php /**/?></td>
    </tr>
    <?php /*endforeach; */?>
    </tbody>
</table>
--><?php //endif; ?>