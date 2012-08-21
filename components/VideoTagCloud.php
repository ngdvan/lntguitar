<?php

Yii::import('zii.widgets.CPortlet');

class VideoTagCloud extends CPortlet
{
//	public $title='Tags';
	public $maxTags=20;
    public $contentCssClass='tagcloud';
    //public $htmlOptions=array('class'=>'portlet','id'=>'videotagcloud');

    public function init()
    {
        $this->id = 'videotagcloud';
        parent::init();
    }
	protected function renderContent()
	{
		$tags=VideoTag::model()->findTagWeights($this->maxTags);

		foreach($tags as $tag=>$weight)
		{
			$link=CHtml::link(CHtml::encode($tag), array('video/tag','tag'=>$tag));
			echo CHtml::tag('span', array(
				'class'=>'tag',
				'style'=>"font-size:".($weight+3)."pt",
			), $link)."\n";

		}
	}
}