<?php
/**
 * @var $this CController
 */
$this->pageTitle = Yii::app()->name.' - '.$news->title;
?>
<h1><?php echo $news->title; ?></h1>
    <abbr>Ngày đăng: <?php echo date('d/m/Y',$news->create_time);?></abbr>
<?php
/**
Yii::import('application.extensions.image.Image');
if ($news->image) :
    Yii::import('application.extensions.image.Image');
    //var_dump(Yii::getPathOfAlias('webroot') . '/' . $image->uri);die;
    $thumbImage = new Image(Yii::getPathOfAlias('webroot') . $news->image);
    $thumbImage->resize(400, 300, Image::AUTO);
    $arr = explode("/",$news->image);
    $file_name = $arr[count($arr)-1];
    $dir = Yii::getPathOfAlias('webroot') . '/resources/images/400x300';
    //var_dump($dir);die;
    $thumb = $dir .'/'. $file_name;
    if(!is_dir($dir)){
        mkdir($dir);
        chmod($dir, 0755);
    }
    $thumbImage->save($thumb);

    */?><!--
<div style="float: left;padding: 0px 10px 10px 0px;">
    <img src="<?php /*echo Yii::app()->baseUrl . '/resources/images/400x300/' . $file_name; */?>">
</div>
--><?php
/*endif;
*/?>
<div style="text-align: justify;margin-top: 20px;">
    <?php echo $news->body; ?>
</div>
