<div class="form">

<?php
//    var_dump($listData);die;
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'term-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vid'); ?>
		<?php echo $form->listBox($model,'vid',CHtml::listData(Vocabulary::model()->findAll(), 'id', 'name'),array('size'=>1)); ?>
		<?php echo $form->error($model,'vid'); ?>
	</div>
    <div class="row">
        <?php echo $form->labelEx($model,'parent'); ?>
        <?php echo $form->listBox($model,'parent',$listData,array('size'=>1)); ?>
        <?php echo $form->error($model,'parent'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Tạo mới' : 'Lưu'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->