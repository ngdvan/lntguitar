<?php
$this->pageTitle = Yii::app()->name . ' - Đăng nhập';
$this->breadcrumbs = array(
    'Đăng nhập',
);
?>

<h1>Đăng nhập</h1>

<div class="form login">
    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
)); ?>


    <div class="row clearfix">
        <label class="required" for="LoginForm_username">Tài khoản:</label>
        <?php //echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username'); ?>
        <?php //echo $form->error($model, 'username'); ?>
    </div>

    <div class="row clearfix">
        <label class="required" for="LoginForm_password">Mật khẩu:</label>
        <?php //echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password'); ?>
        <?php //echo $form->error($model, 'password'); ?>
    </div>

    <div class="row rememberMe">
        <label for="LoginForm_rememberMe">Luôn ở trạng thái đăng nhập:</label>
        <?php echo $form->checkBox($model, 'rememberMe'); ?>
        <?php //echo $form->label($model, 'rememberMe'); ?>
        <?php //echo $form->error($model, 'rememberMe'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('',array('id'=>'gui')); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>
<div class="login-face">
    <h1>Đăng nhập bằng tài khoản facebook</h1>
    Bạn có thể đăng nhập bằng tài khoản facebook của mình
    <p>
        <img src="<?php echo Yii::app()->baseUrl; ?>/images/facelogin.png" alt="">
    </p>
</div>
<!-- form -->
