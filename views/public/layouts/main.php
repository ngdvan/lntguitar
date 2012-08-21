<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css"
          media="screen, projection"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css"
          media="print"/>
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css"
          media="screen, projection"/>
    <![endif]-->

    <link rel="stylesheet" type="text/css"
          href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#txt_username").focus(function () {
                if($(this).val() == 'Tên đăng nhập'){
                    $(this).val('');
                }
            });
            $('#txt_username').blur(function () {
                if($(this).val() == ''){
                    $(this).val('Tên đăng nhập');
                }
            });
            $("#txt_password").focus(function () {
                if($(this).val() == '123456'){
                    $(this).val('');
                }
            });
            $('#txt_password').blur(function () {
                if($(this).val() == ''){
                    $(this).val('123456');
                }
            });
        });
    </script>
</head>
<body>

<div class="container" id="page">
    <div id="topbox" class="clearfix">
        <div id="topbox1">
            <div id="logo">
                <a href="<?php echo Yii::app()->homeUrl; ?>">
                <img
                    src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.jpg" title="<?php echo Yii::app()->name; ?>"/>
                </a>
            </div>
        </div>
        <!-- header -->
        <div id="topbox2">
            <div id="topmenu">

                <?php if (Yii::app()->user->isGuest): ?>
                <div id="topmenu_right">
                    <?php
                    echo CHtml::beginForm(Yii::app()->createUrl('site/login'));
                    ?>
                    <div class="u_login_left">
                        <div class="u_login_center">
                            <div class="u_login_right">
                                <?php
                                echo Chtml::textField('LoginForm[username]', 'Tên đăng nhập', array('id' => 'txt_username'));
                                //echo Chtml::passwordField('password',null,array('id'=>'txt_password'));
                                //echo CHtml::submitButton('',array('id'=>'bt_search'));
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="u_login_left">
                        <div class="u_login_center">
                            <div class="u_login_right">
                                <?php
                                //echo Chtml::textField('username',null,array('id'=>'txt_username'));
                                echo Chtml::passwordField('LoginForm[password]', '123456', array('id' => 'txt_password'));
                                //echo CHtml::submitButton('',array('id'=>'bt_search'));
                                ?>
                            </div>
                        </div>
                    </div>
                    <div id="u_login_bt">
                        <?php echo CHtml::submitButton('', array('id' => 'login_bt')); ?>
                    </div>
                    <?php
                    echo CHtml::endForm();
                    ?>
                </div>
                <?php endif;?>
                <div id="topmenu_left">
                    <div id="topmenu_left_mn">
                        <?php
                        $this->widget('zii.widgets.CMenu', array(
                            'items' => array(
                                array('label' => 'Trang chủ', 'url' => array('/site/index')),
                                array('label' => 'Giới thiệu', 'url' => 'http://lntguitar.com/page/gioi-thieu-ve-lnt-4.html',),
                                array('label' => 'Liên hệ', 'url' => array('/site/contact')),
                                array('label' => 'Diễn đàn', 'url' => Yii::app()->baseUrl.'/forum',),

                            ),
                            'lastItemCssClass' => 'last',
                        ));
                        ?>
                    </div>
                    <?php if (Yii::app()->user->isGuest): ?>
                    <div id="topmenu_left_dk">
                        <?php echo CHtml::link("Đăng ký", '/forum/login.php');?>
                    </div>
                    <?php else: ?>
                    <div id="user_mn">
                        <div id="user_mn_center">
                            <div id="user_mn_right">
                                <?php
                                $this->widget('zii.widgets.CMenu', array(
                                    'items' => array(
                                        array('label' => Yii::app()->user->name, 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                                    ),
                                    'id' => 'user_menu',
                                ));
                                ?>
                            </div>
                        </div>

                    </div>
                    <?php endif;?>

                </div>
            </div>
            <div id="below_topmenu">
                <div id="iface">
                    <?php echo CHtml::button('',array('class'=>'iface1')); ?>
                    <?php echo CHtml::button('',array('class'=>'iface2')); ?>
                    <?php echo CHtml::button('',array('class'=>'tube')); ?>
                </div>
                <div id="left_mainmenu">
                    <div id="inner_mainmenu">
                        <div id="right_mainmenu">
                            <div id="mn_home" title="Trang chủ">
                                <a href="<?php echo Yii::app()->homeUrl; ?>">&nbsp;</a>
                            </div>
                            <div id="right_mn">
                                <div id="mainmenu">
                                    <?php
                                    /* $this->widget('zii.widgets.CMenu',array(
                                                         'items'=>array(
                                                                 array('label'=>'Đào tạo', 'url'=>array('/site/index')),
                                                                 array('label'=>'Thư viện Ứng dụng', 'url'=>array('/site/page', 'view'=>'about')),
                                                                 array('label'=>'Vui chơi - Giải trí', 'url'=>array('/site/contact')),
                                                                 array('label'=>'Dịch vụ', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                                                         ),
                                                 )); */
                                    $data = MenuItems::model()->findAll('parent=:parent', array('parent' => '0'));
                                    $items = array();
                                    if ($data) {
                                        foreach ($data as $pitem) {
                                            $items[] = $pitem->getListed();
                                        }
                                    }
                                    $this->widget('application.components.MainMenu', array(
                                        'items' => $items,
										'activateParents'=>true,
                                        'lastItemCssClass' => 'last',
                                    ));
                                    ?>
									<script type="text/javascript">
										$(document).ready(function(){
											var itemActive = $("ul#nav").find("li.active");
											$("ul#nav").find("li").hover(function(){
												if(!$(this).hasClass('active') && !$(this).parent().parent().parent().parent().parent().parent().hasClass('active')){
													$(itemActive).find("span").css("color","#797979");
													$(itemActive).find("#nav_sub").hide();
												}
											},function(){
												if($(itemActive).find("span").css("color") != '#000'){
													$(itemActive).find("span").css("color","#000");
													
												}
												$(itemActive).find("#nav_sub").show();
											});
										});
									</script>
                                </div>
                                <div id="search_mn">
                                    <div id="search_mn_left">
                                        <div id="search_mn_center">
                                            <div id="search_mn_right">
                                                <?php
                                                echo CHtml::beginForm();
                                                echo Chtml::textField('keyword', null, array('id' => 'txt_key'));
                                                echo CHtml::submitButton('', array('id' => 'bt_search'));
                                                echo CHtml::endForm();
                                                ?>
                                                <!-- <input id="txt_key" name="keyword" type="text" /> <input id="bt_search" type="submit"
                                                                    value="" /> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mainmenu -->
        </div>
    </div>
    <?php echo $content; ?>
    <div class="clear"></div>
    <div id="footer_left">
        <div id="footer_right">
            <div id="footer">
                <div id="copyright">&copy; 2012 LNT Guitar</div>
                <div id="fmenu">
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => 'Trang chủ', 'url' => array('/site/index')),
                            array('label' => 'Giới thiệu', 'url' => 'http://lenguyentran.com/page/gioi-thieu-ve-lnt-4.html'),
                            array('label' => 'Liên hệ', 'url' => array('/site/contact')),
                            array('label' => 'Diễn đàn', 'url' => Yii::app()->baseUrl.'/forum'),

                        ),
                        'lastItemCssClass' => 'last',
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->

</div>
<!-- page -->

</body>
</html>
