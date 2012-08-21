<?php
$this->breadcrumbs=array(
		'Giỏ hàng'=>array('cart'),
		'Hoàn thành đặt hàng'
);

?>
<?php if(Yii::app()->user->hasFlash('buy_complete')):?>
<div class="flash-success">
<?php echo Yii::app()->user->getFlash('buy_complete');?>
</div>
<?php endif;?>