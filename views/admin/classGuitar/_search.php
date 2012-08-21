<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'sku'); ?>
		<?php echo $form->textField($model, 'sku'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'title'); ?>
		<?php echo $form->textField($model, 'title', array('maxlength' => 255)); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model, 'status'); ?>
		<?php echo $form->dropDownList($model, 'status',array('Ẩn','Hiện')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'tid'); ?>
		<?php echo $form->dropDownList($model, 'tid', GxHtml::listDataEx(Training::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', '--Chọn loại khóa học--'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'cid'); ?>
		<?php echo $form->dropDownList($model, 'cid', GxHtml::listDataEx(Center::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', '--Chọn trung tâm--'))); ?>
	</div>

	<!--<div class="row">
		<?php /*echo $form->label($model, 'start_time'); */?>
		<?php /*echo $form->textField($model, 'start_time'); */?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model, 'create_time'); */?>
		<?php /*echo $form->textField($model, 'create_time'); */?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model, 'update_time'); */?>
		<?php /*echo $form->textField($model, 'update_time'); */?>
	</div>
-->
	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Tìm kiếm')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
