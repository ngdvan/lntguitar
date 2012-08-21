<?php
/*$this->breadcrumbs=array(
	'Product',
);*/
?>
<div class="span-17">
    <ul class="p_cate clearfix">
        <li class="lcat1">
            <div
                class="cat1"><?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl . '/images/catproduct_01.jpg'), $this->createUrl('list', array('catid' => 22,'title'=>Lnt::safeTitle("Guitar cổ điển")))); ?></div>
            <div
                class="cat2 xemtiep1"><?php echo CHtml::link("Xem chi tiết", $this->createUrl('list', array('catid' => 22,'title'=>Lnt::safeTitle("Guitar cổ điển")))); ?></div>
        </li>
        <li class="lcat2">
            <div
                class="cat1"><?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl . '/images/catproduct_03.jpg'), $this->createUrl('list', array('catid' => 23,'title'=>Lnt::safeTitle("Guitar Acoustic")))); ?></div>
            <div
                class="cat2 xemtiep2"><?php echo CHtml::link("Xem chi tiết", $this->createUrl('list', array('cat_id' => 23,'title'=>Lnt::safeTitle("Guitar Acoustic")))); ?></div>
        </li>
        <li class="lcat3">
            <div
                class="cat1"><?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl . '/images/catproduct_05.jpg'), $this->createUrl('list', array('catid' => 24,'title'=>Lnt::safeTitle("Guitar điện")))); ?></div>
            <div
                class="cat2 xemtiep3"><?php echo CHtml::link("Xem chi tiết", $this->createUrl('list', array('cat_id' => 24,'title'=>Lnt::safeTitle("Guitar điện")))); ?></div>
        </li>
        <li class="lcat4">
            <div
                class="cat1"><?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl . '/images/catproduct_07.jpg'), $this->createUrl('list', array('catid' => 25,'title'=>Lnt::safeTitle("Phụ kiện")))); ?></div>
            <div
                class="cat2 xemtiep4"><?php echo CHtml::link("Xem chi tiết", $this->createUrl('list', array('catid' => 25,'title'=>Lnt::safeTitle("Phụ kiện")))); ?></div>
        </li>
    </ul>
    <h1 class="title clearfix" style="margin-top: 20px;">sản phẩm bán chạy</h1>
    <?php if (isset($items) && $items): ?>
    <ul class="banchay">
        <?php
        Yii::import('application.extensions.image.Image');
        $i = 1;

        foreach ($items as $item) {
            $class = 'item';
            if ($i == 1 | ($i % 4 == 1)) {
                $class .= ' first';
            } elseif ($i % 4 == 0) {
                $class .= ' last';
            }
            $i++;
            //var_dump($item);die;
            $thumb = new Image(Yii::getPathOfAlias('webroot') . $item['image']);
            $img_url = $thumb->createThumb(140, 195);
            echo CHtml::openTag("li", array('class' => $class));
            echo CHtml::link(CHtml::image($img_url), $this->createUrl('view', array('id' => $item['id'], 'title' => Lnt::safeTitle($item['title']))));
            echo CHtml::openTag("div", array('class' => 'title'));
            echo CHtml::encode($item['title']);
            echo CHtml::closeTag("div");
            echo CHtml::openTag("div", array('class' => 'price'));
            echo CHtml::encode(number_format($item['price'], 0, ',', '.') . 'đ');
            echo CHtml::closeTag("div");

            echo CHtml::openTag("div", array('class' => 'body'));
            echo Lnt::limitWord($item['body'], 10, ',', '.');
            echo CHtml::closeTag("div");
            echo CHtml::closeTag("li");

        }
        ?>
    </ul>
    <?php endif; ?>

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