<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'student-form',
	'enableAjaxValidation' => false,
));
?>


	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model, 'name', array('maxlength' => 100,'class'=>'txt_input')); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model, 'email', array('maxlength' => 100,'class'=>'txt_input')); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'tel'); ?>
		<?php echo $form->textField($model, 'tel', array('maxlength' => 25,'class'=>'txt_input')); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'birthday'); ?>
		<?php echo $form->textField($model, 'birthday', array('maxlength' => 100,'class'=>'txt_input')); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'class_id'); ?>
		<?php
            $criteria = new CDbCriteria();
            $criteria->addCondition("end_time>".time());

            echo $form->dropDownList($model, 'class_id', GxHtml::listDataEx(ClassGuitar::model()->findAllAttributes(null, true,$criteria))); ?>
		</div><!-- row -->
		
		<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model, 'comment'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', ''),array('class' => 'dangky'));
$this->endWidget();
?>
</div><!-- form -->