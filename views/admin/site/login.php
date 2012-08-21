<?php
$this->pageTitle=Yii::app()->name . ' - Đăng nhập';
$this->breadcrumbs=array(
	'Đăng nhập',
);
?>



<div class="form login">
<!--    <h1>Đăng nhập hệ thống quản trị LNT</h1>-->
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('',array('id'=>'sblogin')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
