<?php
return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'),
    array(
        'language' => 'vi',
        'name' => 'Hệ thống quản trị',
        'params' => array(
            'itemsPerPage' => 30,
        ),
    )
);