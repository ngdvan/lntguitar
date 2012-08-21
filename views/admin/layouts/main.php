<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/screen.css"
          media="screen, projection"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/print.css"
          media="print"/>
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/ie.css"
          media="screen, projection"/>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/main.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/form.css"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

    <div id="header">
        <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
    </div>

    <div id="mainMbMenu" class="clearfix">
        <?php
        $this->widget('application.extensions.mbmenu.MbMenu', array(
            'items' => array(
                array('label' => 'Trang chủ', 'url' => array('/site/index')),
                array('label' => 'Phân quyền', 'url' => array('/rights'), 'visible' => !Yii::app()->user->isGuest),
                array('label' => 'Nội dung', 'visiable' => Yii::app()->user->checkAccess('admin'),
                    'items' => array(
                        array('label' => 'Video', 'url' => array('/video/admin')),
                        array('label' => 'Hợp âm', 'url' => array('/hopam/admin')),
                        array('label' => 'Bản nhạc', 'url' => array('/song/admin')),
                        array('label' => 'Giáo viên', 'url' => array('/teacher/admin')),
                        array('label' => 'Loại khóa học', 'url' => array('/training/admin')),
                        array('label' => 'Trung tâm', 'url' => array('/center/admin')),
                        array('label' => 'Lớp học', 'url' => array('/classGuitar/admin')),
                        array('label' => 'Lịch học', 'url' => array('/calendar/admin')),
                        array('label' => 'Tin tức', 'url' => array('/news/admin')),
                        array('label' => 'Trang tĩnh', 'url' => array('/page/admin')),
                        array('label' => 'Slide ảnh', 'url' => array('/slideManager/admin')),
                    )
                , 'visible' => !Yii::app()->user->isGuest
                ),
                array('label' => 'Shop', 'visiable' => Yii::app()->user->checkAccess('admin_user'),
                    'items' => array(
                        array('label' => 'Sản phẩm', 'url' => array('/product/admin')),
                        array('label' => 'Đơn hàng', 'url' => array('/order/admin')),
                    )
                , 'visible' => !Yii::app()->user->isGuest
                ),
                array('label' => 'Danh mục', 'visiable' => Yii::app()->user->checkAccess('admin'),
                    'items' => array(
                        array('label' => 'Loại danh mục', 'url' => array('/vocabulary/admin')),
                        array('label' => 'Danh mục', 'url' => array('/term/admin')),
                        array('label' => 'Menu', 'url' => array('/menu/admin')),
                    )
                , 'visible' => !Yii::app()->user->isGuest
                ),
                array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
            ),
        ));
        ?>
    </div>
    <!-- mainmenu -->

    <?php
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => $this->breadcrumbs,
    ));
    ?><!-- breadcrumbs -->

    <?php echo $content; ?>

    <div id="footer">
        Copyright &copy; <?php echo date('Y'); ?> by LNT.<br/>
        All Rights Reserved.<br/>
        <?php //echo Yii::powered(); ?>
    </div>
    <!-- footer -->

</div>
<!-- page -->

</body>
</html>