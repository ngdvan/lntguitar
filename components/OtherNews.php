<?php
//Yii::import('zii.widgets.CPortlet');
class OtherNews extends CWidget
{
    public $catId = null;
    public $currentId = null;

    public function run()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('status=1');
        if ($this->catId)
            $criteria->addCondition('term_id=' . $this->catId);

        if($this->currentId)
            $criteria->addCondition('id<>' . $this->currentId);

        $criteria->order = 'create_time DESC';
        $criteria->limit = 20;
        $news = News::model()->findAll($criteria);

        echo CHtml::openTag("div", array('class' => 'title', 'style' => 'color: #000000;font-size: 18px;'));
        echo "Tin khác";
        echo CHtml::closeTag("div");
        if ($news) {
            echo CHtml::openTag("ul", array('style' => 'border: 1px solid #CCCCCC;
    border-radius: 4px 4px 4px 4px;
    margin: 8px 0px 0px 0px;
    padding: 10px 5px;list-style:none;'));
            foreach ($news as $n) {
                echo CHtml::openTag('li');
                echo CHtml::link($n->title, array('/news/detail', 'id' => $n->id,'tid'=>$n->term_id,'title'=>Lnt::safeTitle($n->title))) . " <span style='color:#a7a7a7'>($n->view)</span>";
                echo CHtml::closeTag('li');
            }
            echo CHtml::closeTag("ul");
        }
    }
}