<?php
/**
 * @var $data Video
 * @var $image Image
 */
$url = $this->createUrl('view', array('id' => $data->id, 'title' => Lnt::safeTitle($data->title)));
if ($data->image) {
    Yii::import('application.extensions.image.Image');
    //var_dump(Yii::getPathOfAlias('webroot') . '/' . $image->uri);die;
    $thumbImage = new Image(Yii::getPathOfAlias('webroot') . $data->image);
    $thumbImage->resize(110, 70, Image::AUTO);
    $arr = explode("/",$data->image);
    $file_name = $arr[count($arr)-1];
    $dir = Yii::getPathOfAlias('webroot') . '/resources/images/110x70';
    //var_dump($dir);die;
    $thumb = $dir .'/'. $file_name;
    if(!is_dir($dir)){
        mkdir($dir);
        chmod($dir, 0755);
    }
    $thumbImage->save($thumb);
}

?>
<div class="item">
    <?php if ($data->image): ?>
    <div class="img">
        <a href="<?php echo $url; ?>">
            <img src="<?php echo Yii::app()->baseUrl . '/resources/images/110x70/' . $file_name; ?>">
        </a>
    </div>
    <?php endif; ?>
    <div class="title"><?php echo CHtml::link(Lnt::limitWord(CHtml::encode($data->title),5), $url); ?>
    </div>
    <div class="cview">Lượt xem: <?php echo $data->view; ?></div>
</div>
