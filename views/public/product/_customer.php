<?php
/*$this->breadcrumbs=array(
		'Mua nhạc cụ'=>array('index'),
		'Giỏ hàng'=>array('cart'),
		'Thông tin khách hàng'
);*/

?>
<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'customer-_customer-form',
			'enableAjaxValidation'=>false,
)); ?>

    <h1 class="title">Thông tin khách hàng</h1>
	<p class="note">Bạn vui lòng nhập đầy đủ thông tin bên dưới.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row clearfix">
		<?php //echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->hiddenField($model,'user_id'); ?>
		<?php //echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row clearfix">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row clearfix">
		<?php echo $form->labelEx($model,'tel'); ?>
		<?php echo $form->textField($model,'tel'); ?>
		<?php echo $form->error($model,'tel'); ?>
	</div>

	<div class="row clearfix">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row clearfix">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address'); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::button('',array('onclick'=>'javascript:history.go(-1);','id'=>'btBack'))?>
		<?php echo CHtml::submitButton('',array('id'=>'btNext')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>
<!-- form -->
