<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'student-form',
	'enableAjaxValidation' => false,
));
?>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model, 'name', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model, 'email', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'email'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'tel'); ?>
		<?php echo $form->textField($model, 'tel', array('maxlength' => 25)); ?>
		<?php echo $form->error($model,'tel'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'birthday'); ?>
		<?php echo $form->textField($model, 'birthday', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'birthday'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'class_id'); ?>
		<?php echo $form->dropDownList($model, 'class_id', GxHtml::listDataEx(ClassGuitar::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'class_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model, 'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model, 'comment'); ?>
		<?php echo $form->error($model,'comment'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->