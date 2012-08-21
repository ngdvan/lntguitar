<div class="form requirement">
<h1 class="title">Yêu cầu hướng dẫn</h1>
    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'requirement-requirement-form',
    'enableAjaxValidation' => false,
)); ?>


    <?php echo $form->errorSummary($model); ?>

    <div class="row clearfix">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title'); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>
    <div class="row clearfix">
        <?php echo $form->labelEx($model, 'demourl'); ?>
        <?php echo $form->textField($model, 'demourl'); ?>
        <?php echo $form->error($model, 'demourl'); ?>
    </div>
    <div class="row clearfix">
        <?php echo $form->labelEx($model, 'type'); ?>
        <?php echo $form->dropDownList($model, 'type',array(1=>'Bài hát',2=>'Hợp âm')); ?>
        <?php echo $form->error($model, 'type'); ?>
    </div>
    <div class="row clearfix">
        <?php echo $form->labelEx($model, 'requirement'); ?>
        <?php echo $form->textArea($model, 'requirement',array('cols'=>60,'rows'=>8,'resize'=>false)); ?>
        <?php echo $form->error($model, 'requirement'); ?>
    </div>
    <div class="row buttons" style="">
        <?php echo CHtml::submitButton('',array('class'=>'sendyeucau')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->