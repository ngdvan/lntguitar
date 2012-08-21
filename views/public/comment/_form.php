<div class="comment_box form clearfix">
    <div class="title">Bình luận</div>
    <div id="comment_avatar">
        <?php if (Yii::app()->user->isGuest): ?>
        <img src="<?php echo Yii::app()->baseUrl . '/images/avatar.jpg'?>"/>
        <?php else: ?>
        <img src="<?php echo Lnt::get_picture_href(Yii::app()->user->id);?>" width="60" height="60"/>
        <?php  endif;?>
    </div>
    <div id="comment_left">
        <div id="comment_center">
            <div id="comment_right">
                <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'comment-form',
                'enableAjaxValidation' => false,
            )); ?>
                <?php echo $form->textArea($comment, 'contents', array('disabled' => Yii::app()->user->isGuest)); ?>
<!--                --><?php //echo $form->error($comment, 'contents'); ?>
                <?php echo CHtml::submitButton('', array('disabled' => Yii::app()->user->isGuest)); ?>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>