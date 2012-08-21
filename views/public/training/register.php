<h1 id="rgclass">Đăng lớp ký học</h1>
<?php if (Yii::app()->user->hasFlash('success')): ?>

<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>

<?php else: ?>
<?php if (Yii::app()->user->hasFlash('error')): ?>

    <div class="flash-error">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
        <?php endif; ?>
<?php

    $this->renderPartial('_form', array(
        'model' => $model,
        'buttons' => 'create'));
endif;
?>