<div class="form">


    <?php
    Yii::import('application.extensions.image.Image');
    $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'song-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
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
        <?php //echo $form->labelEx($model, 'image'); ?>
        <?php
        //echo $form->textField($model, 'file_path', array('maxlength' => 255));
        //echo $form->fileField($model, 'image');
        ?>
        <?php //echo $form->error($model, 'image'); ?>
        <div>
            <?php
            /*if ($model->image && is_file(Yii::getPathOfAlias('webroot') .  $model->image)):
                $thumbImage = new Image(Yii::getPathOfAlias('webroot') .  $model->image);
                $img_url = $thumbImage->createThumb(110, 70);
                echo CHtml::image($img_url);
            endif;*/
            ?>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'lyrics'); ?>
        <?php echo $form->fileField($model, 'lyrics'); ?>
        <?php echo $form->error($model, 'lyrics'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'embed_code'); ?>
        <?php echo $form->textArea($model, 'embed_code', array('cols' => 70, 'rows' => 5)); ?>
        <?php echo $form->error($model, 'embed_code'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'tid'); ?>
        <?php echo $form->dropDownList($model, 'tid', GxHtml::listDataEx(Term::model()->findAllAttributes(null, true, 'vid=4'))); ?>
        <?php echo $form->error($model, 'tid'); ?>
    </div>
    <!-- row -->
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'ban_artist'); ?>
        <?php $this->widget('CAutoComplete', array(
        'model'=>$model,
        'attribute'=>'ban_artist',
        'url'=>array('bans'),
        'multiple'=>true,
        'htmlOptions'=>array('size'=>50),
    )); ?>
        <?php echo $form->error($model, 'ban_artist'); ?>
    </div>
    <!--<div class="row">
        <?php /*echo $form->labelEx($model, 'ban_id'); */?>
        <?php /*echo $form->dropDownList($model, 'ban_id', GxHtml::listDataEx(Ban::model()->findAllAttributes(null, true))); */?>
        <?php /*echo $form->error($model, 'ban_id'); */?>
    </div>-->
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', array(0 => 'Ẩn', 1 => 'Hiện')); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>
    <!-- row -->
    <?php
    echo GxHtml::submitButton(Yii::t('app', 'Lưu'));
    $this->endWidget();
    ?>
</div><!-- form -->