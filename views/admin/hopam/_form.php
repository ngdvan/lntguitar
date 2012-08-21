<div class="form">


    <?php $form = $this->beginWidget('GxActiveForm', array(
    'id' => 'hopam-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
));
    Yii::import('application.extensions.image.Image');
    ?>
    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('maxlength' => 255,'size'=>60)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'image'); ?>
        <?php
        //echo $form->textField($model, 'file_path', array('maxlength' => 255));
        echo $form->fileField($model, 'image');
        ?>
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
        <?php echo $form->labelEx($model, 'lyrics'); ?>
        <?php //echo $form->textArea($model, 'lyrics',array('cols'=>70,'rows'=>15));
        echo $form->fileField($model, 'lyrics');
        if($model->lyrics){
            echo "File: ".CHtml::link("Download",Yii::app()->createUrl('hopam/download',array('path'=>$model->lyrics)));
        }
        ?>
        <p class="hint">Chú ý: Lời là file xml chứa nội dung của lời và hợp âm</p>
        <?php echo $form->error($model, 'lyrics'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'embed_code'); ?>
        <?php echo $form->textArea($model, 'embed_code',array('cols'=>70,'rows'=>5)); ?>
        <?php echo $form->error($model, 'embed_code'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'tid'); ?>
        <?php echo $form->dropDownList($model, 'tid', GxHtml::listDataEx(Term::model()->findAllAttributes(null, true,'vid=3'))); ?>
        <?php echo $form->error($model, 'tid'); ?>
    </div>
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
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'guider'); ?>
        <?php echo $form->textField($model, 'guider', array('maxlength' => 100)); ?>
        <?php echo $form->error($model, 'guider'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'tags'); ?>
        <?php //echo $form->textField($model, 'tags', array('maxlength' => 255)); ?>
        <?php $this->widget('CAutoComplete', array(
        'model' => $model,
        'attribute' => 'tags',
        'url' => array('suggestTags'),
        'multiple' => true,
        'htmlOptions' => array('size' => 50),
    )); ?>
        <?php echo $form->error($model, 'tags'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', array(0 => 'Ân', 1 => 'Hiện')); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>
    <!-- row -->

    
    <?php
    echo GxHtml::submitButton(Yii::t('app', 'Lưu'));
    $this->endWidget();
    ?>
</div><!-- form -->