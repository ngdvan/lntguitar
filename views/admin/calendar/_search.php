<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'day'); ?>
		<?php echo $form->textField($model, 'day'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'time'); ?>
		<?php echo $form->textField($model, 'time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'class_id'); ?>
		<?php echo $form->dropDownList($model, 'class_id', GxHtml::listDataEx(ClassGuitar::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
