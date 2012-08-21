<div class="form">
    <?php
    /**
     * @var $form GxActiveForm
     */
    $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'teacher-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    Yii::import('application.extensions.image.Image');
    ?>
    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>

    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'picture'); ?>
        <?php
        //echo $form->textField($model, 'picture', array('maxlength' => 255));
        echo $form->fileField($model, 'picture');
        ?>
        <?php echo $form->error($model, 'picture'); ?>
        <div>
            <?php
            if ($model->picture):
                $thumbImage = new Image(Yii::getPathOfAlias('webroot') . '/' . $model->picture);
                $img_url = $thumbImage->createThumb(110, 70);
                echo CHtml::image($img_url);
            endif;
            ?>
        </div>
    </div>
	<div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('maxlength' => 255)); ?>
        <?php echo $form->error($model, 'username'); ?>

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
    <div class="row">
        <label><?php echo GxHtml::encode($model->getRelationLabel('photos')); ?></label>
        <?php
        $this->widget('CMultiFileUpload', array(
            'name' => 'photos',
            'accept' => 'jpg|png|jpeg',
            'max' => 3,
            'remove' => Yii::t('ui', 'Remove'),
            //'denied'=>'', message that is displayed when a file type is not allowed
            //'duplicate'=>'', message that is displayed when a file appears twice
            'htmlOptions' => array('size' => 25),
        ));
        if ($model->teacherPhotos) {

            echo "<fieldset><legend>Photos</legend><ul>";
            foreach ($model->teacherPhotos as $img) {
                $thumbImage = new Image(Yii::getPathOfAlias('webroot') . '/' . $img->photo);
                $img_url = $thumbImage->createThumb(110, 70);
                /*$thumbImage->resize(110, 70,Image::AUTO);
                $arr = explode("/",$img->photo);
                $file_name = $arr[count($arr)-1];
                $thumb = Yii::getPathOfAlias('webroot') .  '/resources/images/110x70/' . $file_name;
                $thumbImage->save($thumb);*/
                echo "<li id='img_" . $img->id . "'><img src='" . $img_url . "' />" . CHtml::ajaxButton('Xóa', $this->createUrl('delphoto', array('id' => $img->id)), array('success' => 'js:function(){$("#img_' . $img->id . '").remove()}')) . "</li>";
            }
            echo "</ul></fieldset>";
        }
        ?>
    </div>
    <!-- row -->
    <label><?php //echo GxHtml::encode($model->getRelationLabel('videos')); ?></label>
    <?php //echo $form->checkBoxList($model, 'videos', GxHtml::encodeEx(GxHtml::listDataEx(Video::model()->findAllAttributes(null, true)), false, true)); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'pos'); ?>
        <?php echo $form->textField($model, 'pos', array('maxlength' => 11)); ?>
        <?php echo $form->error($model, 'pos'); ?>

    </div>
    <?php
    echo GxHtml::submitButton($model->isNewRecord ? 'Tạo mới' : 'Lưu');
    $this->endWidget();
    ?>
</div><!-- form -->