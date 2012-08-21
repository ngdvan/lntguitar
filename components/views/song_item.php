<?php
/**
 * User: thanhdx
 * Date: 6/7/12
 * Time: 11:54 PM
 * @file song_item.php
 */
echo CHtml::link($data->title. "($data->view)",array('/song/view','id'=>$data->id));