<?php
/*$this->breadcrumbs=array(
    $model->title,
);*/
$this->pageTitle= "Trang cá nhân | ".$user->username;
?>
<div class="span-17">
    <div class="profile_head">
        <ul>
            <li><?php echo CHtml::link("Các hoạt động",'#',array('class'=>'active','style'=>"margin-left:0;padding-left:0;")); ?></li>
            <li><?php echo CHtml::link("Học viên"); ?></li>
            <li><?php echo CHtml::link("Quan tâm"); ?></li>
            <li><?php echo CHtml::link("Mua bán"); ?></li>
        </ul>
    </div>
    <div class="profile clearfix">
        <div class="tieude">Bài giảng</div>
        <?php
        Yii::import('application.extensions.image.Image');
        function getImgThumb($item){
            $path = Yii::getPathOfAlias('webroot').$item['image'];
            if(file_exists($path)){
                $img = new Image($path);
                return $img->createThumb(105,70);
            }else{
                return Lnt::getYoutubeImage($item['link_youtube']);
            }
        }
        if($video){
            $i=1;
            foreach($video as $item){
                $c2 = $i%2 == 0 ? "c2item":"";
                $item['body'] = Lnt::limitWord($item['body'],12);
                echo CHtml::openTag("div",array("class"=>"item ".$c2));
                echo CHtml::image(Lnt::getYoutubeImage($item['link_youtube']));
                echo CHtml::openTag("div",array('class'=>'title'));
                echo CHtml::link(Lnt::limitWord($item['title'],8),$this->createUrl('/video/view',array('id'=>$item['id'],'title'=>Lnt::safeTitle($item['title']))),array('title'=>$item['title']));
                echo CHtml::closeTag("div");
                echo CHtml::openTag("div",array('class'=>'body'));
                echo $item['body'];
                echo CHtml::closeTag("div");
                echo CHtml::closeTag("div");
                $i++;
            }
        }
        ?>
    </div>
</div>
<!-- content -->
<div class="span-6 last">
    <?php
    $this->widget('BoxProfile',array('user'=>$user));
    echo "<div style='margin-top:15px;'><img src='".Yii::app()->baseUrl."/images/cosogiangday_03.jpg'/></div>";
    ?>

</div>