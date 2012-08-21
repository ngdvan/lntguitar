<?php

Yii::import('zii.widgets.CPortlet');

class VideoFilter extends CPortlet
{
//	public $title='Tags';
    public $maxTags = 20;
    public $contentCssClass = 'vf_inner';

    //public $htmlOptions=array('class'=>'portlet','id'=>'videotagcloud');

    public function init()
    {
        $this->id = 'video_filter';
        parent::init();
    }

    protected function renderContent()
    {
        $items = array(
            array('label' => 'Tất cả', 'url' => array('video/index')),
            array('label' => 'Mới nhất', 'url' => array('video/list', 'filter' => 'latest')),
            array('label' => 'Xem nhiều nhất', 'url' => array('video/list', 'filter' => 'top_view')),
            array('label' => 'Bình chọn nhiều nhất', 'url' => array('video/list', 'filter' => 'top_like')),
        );
        /*$terms = Term::model()->findAll('vid = 2');
        foreach ($terms as $term) {
            $items[] =
                array('label' => $term->name, 'url' => array('video/catlist', 'catid' => $term->id, 'catname' => Lnt::safeTitle($term->name)));
        }*/
        $this->widget('zii.widgets.CMenu',
            array(
                'items' => $items,
                'activateItems' => true,
            )
        );
    }
}