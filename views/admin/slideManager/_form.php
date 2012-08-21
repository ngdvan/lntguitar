<div class="form">
    <?php
    Yii::import('application.extensions.image.Image');
    $form = $this->beginWidget('GxActiveForm', array(
    'id' => 'slide-manager-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
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
        <?php echo $form->labelEx($model, 'url'); ?>
        <?php echo $form->textField($model, 'url', array('maxlength' => 255,'size'=>60)); ?>
        <?php echo $form->error($model, 'url'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'image'); ?>
        <?php echo $form->fileField($model, 'image'); ?>
        <?php echo $form->error($model, 'image'); ?>
        <div>
            <?php
            if ($model->image):
                $thumbImage = new Image(Yii::getPathOfAlias('webroot') . '/' . $model->image);
                $img_url = $thumbImage->createThumb(110, 70);
                echo CHtml::image($img_url);
            endif;
            ?>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'pos'); ?>
        <?php echo $form->dropDownList($model, 'pos',array(1,2,3,4,5,6,7,8,9,10,12,13,14,15,16,17,18,19,20)); ?>
        <?php echo $form->error($model, 'pos'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', array(0 => 'Ẩn', 1 => 'Hiện'));?>
        <?php echo $form->error($model, 'status'); ?>
    </div>
    <!-- row -->


    <?php
    echo GxHtml::submitButton(Yii::t('app', 'Save'));
    $this->endWidget();
    ?>
</div><!-- form -->