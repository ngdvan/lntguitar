<?php
/**
 * User: thanhdx
 * Date: 6/7/12
 * Time: 11:55 PM
 * @file newest_song.php
 */
$this->widget('zii.widgets.CListView',array('dataProvider'=>$songs,'itemView'=>'song_item','summaryText'=>'Bản nhạc mới nhất'));