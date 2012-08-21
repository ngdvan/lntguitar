<?php
/**
 * @var $data Video
 * @var $image Image
 */
$url = $this->createUrl('/video/view', array('id' => $data->id, 'title' => Lnt::safeTitle($data->title)));
//$imageUrl = Lnt::getYoutubeImage($data->link_youtube);
?>
<div class="item">
    <div class="img">
        <?php echo CHtml::link(CHtml::image(Lnt::getYoutubeImage($data->link_youtube)), $url); ?>
    </div>
    <div class="title"><?php echo CHtml::link(Lnt::limitWord(CHtml::encode($data->title), 5), $url); ?>
    </div>
    <div class="cview">Lượt xem: <?php echo $data->view; ?></div>
</div>
