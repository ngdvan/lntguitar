<?php

Yii::import('zii.widgets.CPortlet');

class VideoCategories extends CPortlet
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
        /*$items = array(
            array('label' => 'Tất cả', 'url' => array('video/index')),
            array('label' => 'Mới nhất', 'url' => array('video/list', 'filter' => 'latest')),
            array('label' => 'Xem nhiều nhất', 'url' => array('video/list', 'filter' => 'top_view')),
            array('label' => 'Bình chọn nhiều nhất', 'url' => array('video/list', 'filter' => 'top_like')),
        );*/
        $terms = Term::model()->findAll('vid = 2 AND parent = 0');
        foreach ($terms as $term) {
            $item = array('label' => $term->name, 'url' => array('video/catlist', 'catid' => $term->id, 'catname' => Lnt::safeTitle($term->name)));
            $items[] =$item;
            $subTerms = Term::model()->findAll('vid = 2 AND parent = '.$term->id);
            if($subTerms){
                foreach($subTerms as $sTerm){
                    $items[] = array('itemOptions'=>array('class'=>'sub'),'label' => $sTerm->name, 'url' => array('video/catlist', 'catid' => $sTerm->id, 'catname' => Lnt::safeTitle($sTerm->name)));
                }
            }




        }
        echo "<div style='margin: 10px 0px;color: #000000;
    font-weight: bold;
    text-align: left;
    text-transform: uppercase;'>Danh mục</div>";
        $this->widget('zii.widgets.CMenu',
            array(
                'items' => $items,
                'activateItems' => true,
            )
        );
    }
}