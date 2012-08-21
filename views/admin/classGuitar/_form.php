<div class="form">


    <?php $form = $this->beginWidget('GxActiveForm', array(
    'id' => 'class-guitar-form',
    'enableAjaxValidation' => false,
));
    ?>
    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('maxlength' => 255, 'size' => 70)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'sku'); ?>
        <?php echo $form->textField($model, 'sku', array('maxlength' => 255, 'size' => 70)); ?>
        <?php echo $form->error($model, 'sku'); ?>
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
        <?php echo $form->labelEx($model, 'max'); ?>
        <?php echo $form->textField($model, 'max', array('maxlength' => 255, 'size' => 70)); ?>
        <?php echo $form->error($model, 'max'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'teacher_id'); ?>
        <?php echo $form->dropDownList($model, 'teacher_id', GxHtml::listDataEx(Teacher::model()->findAllAttributes(null, true))); ?>
        <?php echo $form->error($model, 'teacher_id'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'tid'); ?>
        <?php echo $form->dropDownList($model, 'tid', GxHtml::listDataEx(Training::model()->findAllAttributes(null, true))); ?>
        <?php echo $form->error($model, 'tid'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'cid'); ?>
        <?php echo $form->dropDownList($model, 'cid', GxHtml::listDataEx(Center::model()->findAllAttributes(null, true))); ?>
        <?php echo $form->error($model, 'cid'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'start_time'); ?>
        <?php
        //echo $form->textField($model, 'start_time');
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'ClassGuitar[start_time]',
            'language' => 'vi',
            'options' => array(
                'showAnim' => 'fold',
            ),
            'value' => date('d/m/Y', $model->start_time ? $model->start_time : time()),
            'htmlOptions' => array(
                'style' => 'height:20px;'
            ),
        ));
        ?>
        <?php echo $form->error($model, 'start_time'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'end_time'); ?>
        <?php //echo $form->textField($model, 'end_time');
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'ClassGuitar[end_time]',
            'language' => 'vi',
            'options' => array(
                'showAnim' => 'fold',
            ),
            'value' => date('d/m/Y', $model->end_time ? $model->end_time : time()),
            'htmlOptions' => array(
                'style' => 'height:20px;'
            ),
        ));
        ?>
        <?php echo $form->error($model, 'end_time'); ?>
    </div>
    <!-- row -->
    <!--		<label>--><?php //echo GxHtml::encode($model->getRelationLabel('classCalendars')); ?><!--</label>-->
    <!--		--><?php //echo $form->checkBoxList($model, 'classCalendars', GxHtml::encodeEx(GxHtml::listDataEx(ClassCalendar::model()->findAllAttributes(null, true)), false, true)); ?>
    <!--		<label>--><?php //echo GxHtml::encode($model->getRelationLabel('userClasses')); ?><!--</label>-->
    <!--		--><?php //echo $form->checkBoxList($model, 'userClasses', GxHtml::encodeEx(GxHtml::listDataEx(UserClass::model()->findAllAttributes(null, true)), false, true)); ?>

    <?php
    echo GxHtml::submitButton(Yii::t('app', 'Save'));
    $this->endWidget();
    ?>
</div><!-- form -->