<?php
/**
 * @var $data Product
 * @var $image Image
 */
$thumb = new Image(Yii::getPathOfAlias('webroot').$data['image']);
$img_url = $thumb->createThumb(140,195);
echo CHtml::openTag("li",array('class'=>'item'));
echo CHtml::link(CHtml::image($img_url),$this->createUrl('view',array('id'=>$data['id'],'title'=>Lnt::safeTitle($data['title']))));
echo CHtml::openTag("div",array('class'=>'title'));
echo CHtml::encode($data['title']);
echo CHtml::closeTag("div");
echo CHtml::openTag("div",array('class'=>'price'));
echo CHtml::encode(number_format($data['price'],0,',','.').'đ');
echo CHtml::closeTag("div");

echo CHtml::openTag("div",array('class'=>'body'));
echo Lnt::limitWord($data['body'],10,',','.');
echo CHtml::closeTag("div");
echo CHtml::closeTag("li");
