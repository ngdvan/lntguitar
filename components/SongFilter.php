<?php

Yii::import('zii.widgets.CPortlet');

class SongFilter extends CPortlet
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
        $extra = '';
        if (isset($_GET['c']))
        {
            $url = array('/song/index',
                'c'=>$_GET['c']
            );
        }else{
            $url = array('/song/index',
            );
        }

        $terms = Term::model()->findAll('vid = 4');
        $menuItems[] = array('label' => 'Tất cả', 'url' => $url, 'active' => (!isset($_GET['c']) && !isset($_GET['tid'])) ? true : false,);
        foreach ($terms as $term) {
            if (isset($_GET['c']))
            {
                $url = array('/song/index',
                    'tid' => $term->id,
                    'c'=>$_GET['c']
                );
            }else{
                $url = array('/song/index',
                    'tid' => $term->id
                );
            }
            $menuItems[] = array(
                'label' => $term->name,
                'url'=>$url
            );
        }


        $this->widget('zii.widgets.CMenu',
            array(
                'items' => $menuItems,
                'activateItems' => true,
            )
        );
    }
}