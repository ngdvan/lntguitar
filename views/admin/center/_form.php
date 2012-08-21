<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'center-form',
	'enableAjaxValidation' => false,
));
?>
	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model, 'title', array('maxlength' => 255,'size'=>60)); ?>
		<?php echo $form->error($model,'title'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php //echo $form->textArea($model, 'body');
            /*$this->widget('application.extensions.cleditor.ECLEditor', array(
                'model' => $model,
                'attribute' => 'body', //Model attribute name. Nome do atributo do modelo.
                'options' => array(
                    'width' => '700',
                    'height' => '400',
                    'useCSS' => true,
                ),
            ));*/
            $this->widget('application.extensions.tinymce.ETinyMce',
                array(
                    //'name' => 'Video[body]',
                    'language' => 'en',
                    'editorTemplate'=>'full',
                    'model'=>$model,
                    'attribute'=>'body'
                )
            );
            ?>
		<?php echo $form->error($model,'body'); ?>
		</div><!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'province_id'); ?>
        <?php echo $form->dropDownList($model, 'province_id', CMap::mergeArray(array(0=>'Chọn tỉnh/tp'),GxHtml::listDataEx(Term::model()->findAllAttributes(null, true,'vid=5 AND parent = 0')))); ?>
        <?php echo $form->error($model, 'province_id'); ?>
    </div>
		<div class="row">
		<?php echo $form->labelEx($model,'district_id'); ?>
            <?php echo $form->dropDownList($model, 'district_id', CMap::mergeArray(array(0=>'Chọn quận/huyện'),($model->province_id ? GxHtml::listDataEx(Term::model()->findAllAttributes(null, true,'vid=5 AND parent = '.$model->province_id)) : array()))); ?>
		<?php echo $form->error($model,'district_id'); ?>
		</div><!-- row -->

		<label><?php //echo GxHtml::encode($model->getRelationLabel('classGuitars')); ?></label>
<!--		--><?php //echo $form->checkBoxList($model, 'classGuitars', GxHtml::encodeEx(GxHtml::listDataEx(ClassGuitar::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->