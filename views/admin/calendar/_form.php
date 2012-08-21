<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'class-calendar-form',
	'enableAjaxValidation' => false,
));
?>
	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'day'); ?>
		<?php
            //echo $form->textField($model, 'day');
            echo $form->dropDownList($model, 'day',array(1=>'Chủ nhật',2=>'Thứ hai',3=>'Thứ ba',4=>'Thứ tư',5=>'Thứ năm',6=>'Thứ sáu',7=>'Thứ bảy'));
            ?>
		<?php echo $form->error($model,'day'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'start_time'); ?>
		<?php echo $form->textField($model, 'start_time'); ?>
		<?php echo $form->error($model,'start_time'); ?>
		</div><!-- row -->
    <div class="row">
		<?php echo $form->labelEx($model,'end_time'); ?>
		<?php echo $form->textField($model, 'end_time'); ?>
		<?php echo $form->error($model,'end_time'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'class_id'); ?>
		<?php echo $form->dropDownList($model, 'class_id', GxHtml::listDataEx(ClassGuitar::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'class_id'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->
<script type="text/javascript">
    $(function () {
        $('#ClassCalendar_start_time').timepicker({});
        $('#ClassCalendar_end_time').timepicker({});
    });
</script>