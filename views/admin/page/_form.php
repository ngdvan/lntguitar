<div class="form">


    <?php $form = $this->beginWidget('GxActiveForm', array(
    'id' => 'page-form',
    'enableAjaxValidation' => false,
));
    ?>
    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('maxlength' => 255,'size'=>60)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'body'); ?>
        <?php
        //echo $form->textArea($model, 'body');
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
        <?php echo $form->error($model, 'body'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', array(0 => 'Ẩn', 1 => 'Hiện')); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>
    <!-- row -->
    <!--<div class="row">
		<?php /*echo $form->labelEx($model,'user_id'); */?>
		<?php /*echo $form->dropDownList($model, 'user_id', GxHtml::listDataEx(XfUser::model()->findAllAttributes(null, true))); */?>
		<?php /*echo $form->error($model,'user_id'); */?>
		</div>--><!-- row -->

    <?php
    echo GxHtml::submitButton(Yii::t('app', 'Lưu'));
    $this->endWidget();
    ?>
</div><!-- form -->