<?php
/**
 * @var $data Video
 * @var $image Image
 */
$url = $this->createUrl('view', array('id' => $data->id, 'title' => Lnt::safeTitle($data->title)));
$imageUrl='';
Yii::import('application.extensions.image.Image');
    //var_dump(Yii::getPathOfAlias('webroot') . '/' . $image->uri);die;
    $filePath = Yii::getPathOfAlias('webroot') .'/'. $data->image;
    if(is_file($filePath)){
		$imageUrl = Lnt::createImage($filePath,105,70);
    }else{
        $imageUrl = Lnt::getYoutubeImage($data->link_youtube);
    }

?>
<div class="item">
    <?php //if ($data->image): ?>
    <div class="img">
        <a href="<?php echo $url; ?>">
            <img src="<?php echo $imageUrl; ?>" width="110" height="70">
        </a>
    </div>
    <?php //endif; ?>
    <div class="title"><?php echo CHtml::link(Lnt::limitWord(CHtml::encode($data->title),5), $url,array('title'=>$data->title)); ?>
    </div>
    <div class="cview">Lượt xem: <?php echo $data->view; ?></div>
</div>
