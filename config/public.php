<?php
return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'),
    array(
        'components' => array(
            'urlManager'=>array(
                'urlFormat'=>'path',
                'showScriptName' => false,
                'urlSuffix' => '.html',
                'rules'=>array(
                    ''=>'site/index',
                    'lien-he'=>'site/contact',
                    'page/<title:.*?>-<id:\d+>'=>'page/view',
                    'video'=>'video/index',
                    'video/<title:.*?>-<id:\d+>'=>'video/view',
                    'video-list'=>'video/list',
                    'video/cat/<catname:.*?>_<catid:\d+>'=>'video/catlist',
                    'hop-am'=>'hopam/index',
                    'hop-am/<title:.*?>-<id:\d+>'=>'hopam/view',
                    'ban-nhac'=>'song/index',
                    'ban-nhac/<title:.*?>-<id:\d+>'=>'song/view',
                    'yeu-cau-nhac'=>'song/requirement',
                    'khoa-hoc'=>'training/index',
                    'khoa-hoc/list'=>'training/list',
                    /*'khoa-hoc/cat-<tid:\d+>-<title:.*?>'=>'training/list',*/
                    'dang-ky-hoc'=>'training/register',
                    'khoa-hoc/<title:.*?>-<id:\d+>'=>'training/class',
                    'trung-tam/<title:.*?>-<id:\d+>'=>'training/center',
                    'giang-vien'=>'teacher/index',
                    'giang-vien/<title:.*?>-<id:\d+>'=>'teacher/view',
                    'tin-tuc-<tid:\d+>'=>'news/list',
                    'tin-tuc/<tid:\d+>-<title:.*?>-<id:\d+>'=>'news/detail',
                    'ban-dan'=>'product/index',
                    'gio-hang'=>'product/cart',
                    'ban-dan/<title:.*?>-<id:\d+>'=>'product/view',
                    'ban-dan/cat-<catid:\d+>-<title:.*?>'=>'product/list',
                    'dang-nhap'=>'site/login',
                    'logout'=>'site/logout',

                    '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                ),
            ),
            'cache'=>array(
                'class'=>'system.caching.CFileCache',
                /*'cachePath'=>array(
                    array('host'=>'server1', 'port'=>11211, 'weight'=>60),
                    array('host'=>'server2', 'port'=>11211, 'weight'=>40),
                ),*/
            ),
        ),
        'params' => array(
            'itemsPerPage' => 20,
            'adminEmail'=>'vuha@lntguitar.com',
        ),
    )
);