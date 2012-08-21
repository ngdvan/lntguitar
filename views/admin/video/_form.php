<div class="form">


    <?php $form = $this->beginWidget('GxActiveForm', array(
    'id' => 'video-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
));
    Yii::import('application.extensions.image.Image');
    ?>

    <p class="note">
        <?php echo Yii::t('app', 'Trường có dấu'); ?> <span
        class="required">*</span> <?php echo Yii::t('app', 'là bắt buộc'); ?>.
    </p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('maxlength' => 255, 'size' => 100)); ?>
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
        <div id="image_box">
            <?php
            $imagPath = Yii::getPathOfAlias('webroot') . '/' . $model->image;
            //var_dump($imagPath);die;
            if (file_exists($imagPath) && is_file($imagPath)):
                $thumbImage = new Image($imagPath);
                $img_url = $thumbImage->createThumb(110, 70);
                echo CHtml::image($img_url, $model->title, array('id' => 'image'));
                echo CHtml::ajaxButton('Xóa', $this->createUrl('delImage', array('id' => $model->id)), array('success' => 'js:function(){$("#image_box").remove()}'));

            endif;
            ?>
        </div>
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
        ?>
        <?php
        /*        $this->widget('ext.ckeditor.CKEditorWidget', array(
            "model" => $model, # Data-Model
            "attribute" => 'body', # Attribute in the Data-Model
            //"defaultValue" => "", # Optional

            # Additional Parameter (Check http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html)
            "config" => array(
                "height" => "400px",
                "width" => "100%",
                "toolbar" => "Full",
            ),

            #Optional address settings if you did not copy ckeditor on application root
            "ckEditor" => Yii::getPathOfAlias('webroot') . "/ckeditor/ckeditor.php",
            # Path to ckeditor.php
            "ckBasePath" => Yii::app()->baseUrl . "/ckeditor/",
            # Realtive Path to the Editor (from Web-Root)
        ));
        */?>
        <?php
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
        <?php echo $form->labelEx($model, 'link_youtube'); ?>
        <?php echo $form->textField($model, 'link_youtube', array('maxlength' => 255, 'size' => 50)); ?>
        <?php echo $form->error($model, 'link_youtube'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'tags'); ?>
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
    <!--<div class="row">
        <?php /*echo $form->labelEx($model, 'file_path'); */?>
        <?php
    /*        //echo $form->textField($model, 'file_path', array('maxlength' => 255));
    echo $form->fileField($model, 'file_path');
    */?>
        <?php /*echo $form->error($model, 'file_path'); */?>
    </div>-->
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'term_id'); ?>
        <?php echo $form->dropDownList($model, 'term_id', GxHtml::listDataEx(Term::model()->findAllAttributes(null, true, 'vid=2'))); ?>
        <?php echo $form->error($model, 'term_id'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'teacher_id'); ?>
        <?php echo $form->dropDownList($model, 'teacher_id', GxHtml::listDataEx(Teacher::model()->findAllAttributes(null, true))); ?>
        <?php echo $form->error($model, 'teacher_id'); ?>
    </div>
    <!-- row -->
    <?php
    echo GxHtml::submitButton(Yii::t('app', 'Lưu'));
    $this->endWidget();
    ?>
</div><!-- form -->