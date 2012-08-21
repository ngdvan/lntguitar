<div class="form">
    <?php
    Yii::import('application.extensions.image.Image');
    /**
     * @var $form GxActiveForm
     */
    $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'product-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('maxlength' => 255, 'size' => 60)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'image'); ?>
        <?php
        //echo $form->textField($model, 'picture', array('maxlength' => 255));
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
    <div class="row">
        <?php echo $form->labelEx($model, 'code'); ?>
        <?php echo $form->textField($model, 'code', array('maxlength' => 100)); ?>
        <?php echo $form->error($model, 'code'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'mpn_code'); ?>
        <?php echo $form->textField($model, 'mpn_code', array('maxlength' => 100)); ?>
        <?php echo $form->error($model, 'mpn_code'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'price'); ?>
        <?php echo $form->textField($model, 'price'); ?>
        <?php echo $form->error($model, 'price'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'video'); ?>
        <?php echo $form->textField($model, 'video', array('size'=>60)); ?>
        <?php echo $form->error($model, 'video'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'teach_info'); ?>
        <?php
        //echo $form->textArea($model, 'teach_info');
       /* $this->widget('application.extensions.cleditor.ECLEditor', array(
            'model' => $model,
            'attribute' => 'teach_info', //Model attribute name. Nome do atributo do modelo.
            'options' => array(
                'width' => '700',
                'height' => '200',
                'useCSS' => true,
            ),
        ));*/
        $this->widget('application.extensions.tinymce.ETinyMce',
            array(
                //'name' => 'Video[body]',
                'language' => 'en',
                'editorTemplate'=>'full',
                'model'=>$model,
                'attribute'=>'teach_info'
            )
        );
        ?>
        <?php echo $form->error($model, 'teach_info'); ?>
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
    <div class="row">
        <?php echo $form->labelEx($model, 'cat_id'); ?>
        <?php echo $form->dropDownList($model, 'cat_id', GxHtml::listDataEx(Term::model()->findAllAttributes(null, true, 'vid=6'))); ?>
        <?php echo $form->error($model, 'cat_id'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'th_id'); ?>
        <?php echo $form->dropDownList($model, 'th_id', GxHtml::listDataEx(Term::model()->findAllAttributes(null, true, 'vid=7'))); ?>
        <?php echo $form->error($model, 'th_id'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'count_buy'); ?>
        <?php echo $form->textField($model, 'count_buy'); ?>
        <?php echo $form->error($model, 'count_buy'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', array('Ẩn', 'Hiện', 'Hết hàng')); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>
    <!-- row -->
    <div class="row">
        <label><?php echo GxHtml::encode($model->getRelationLabel('productImages')); ?></label>
        <?php
        $this->widget('CMultiFileUpload', array(
            'name' => 'photos',
            'accept' => 'jpg|png|jpeg',
            'max' => 5,
            'remove' => Yii::t('ui', 'Remove'),
            'duplicate' => 'Duplicate file!', // useful, i think
            'denied' => 'Invalid file type',
            'htmlOptions' => array('size' => 25),
        ));
        if ($model->productImages) {

            echo "<fieldset><legend>Ảnh sản phẩm</legend><ul>";
            foreach ($model->productImages as $img) {
                $thumbImage = new Image(Yii::getPathOfAlias('webroot') . '/' . $img->file_path);
                $img_url = $thumbImage->createThumb(110, 70);
                echo "<li id='img_" . $img->id . "'><img src='" . $img_url . "' />" . CHtml::ajaxButton('Xóa', $this->createUrl('delphoto', array('id' => $img->id)), array('success' => 'js:function(){$("#img_' . $img->id . '").remove()}')) . "</li>";
            }
            echo "</ul></fieldset>";
        }
        ?>
    </div>
    <?php
    echo GxHtml::submitButton(Yii::t('app', 'Save'));
    $this->endWidget();
    ?>
</div><!-- form -->