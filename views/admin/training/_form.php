<div class="form">


    <?php $form = $this->beginWidget('GxActiveForm', array(
    'id' => 'training-form',
    'enableAjaxValidation' => false,
));
    ?>
    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('maxlength' => 255)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'body'); ?>
        <?php
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

    <label><?php echo GxHtml::encode($model->getRelationLabel('classGuitars')); ?></label>
    <?php echo $form->checkBoxList($model, 'classGuitars', GxHtml::encodeEx(GxHtml::listDataEx(ClassGuitar::model()->findAllAttributes(null, true)), false, true)); ?>

    <?php
    echo GxHtml::submitButton(Yii::t('app', 'Save'));
    $this->endWidget();
    ?>
</div><!-- form -->