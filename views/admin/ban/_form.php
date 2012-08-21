<div class="form">


    <?php $form = $this->beginWidget('GxActiveForm', array(
    'id' => 'ban-form',
    'enableAjaxValidation' => false,
));
    ?>
    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('maxlength' => 255, 'size' => '60')); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'body'); ?>
        <?php //echo $form->textArea($model, 'body');
        $this->widget('application.extensions.cleditor.ECLEditor', array(
            'model' => $model,
            'attribute' => 'body', //Model attribute name. Nome do atributo do modelo.
            'options' => array(
                'width' => '700',
                'height' => '400',
                'useCSS' => true,
            ),
        ));
        ?>
        <?php echo $form->error($model, 'body'); ?>
    </div>
    <!-- row -->
    <?php
    echo GxHtml::submitButton(Yii::t('app', 'Lưu'));
    $this->endWidget();
    ?>
</div><!-- form -->