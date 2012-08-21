<?php

Yii::import('application.models._base.BaseHopam');

class Hopam extends BaseHopam
{
    private $_oldTags;
    private $_oldBans;
    public static function model($className=__CLASS__) {
		return parent::model($className);
	}


    /**
     * @return array a list of links that point to the post list filtered by every tag of this post
     */
    public function getTagLinks()
    {
        $links=array();
        foreach(HopamTag::string2array($this->tags) as $tag)
            $links[]=CHtml::link(CHtml::encode($tag), array('hopam/index', 'tag'=>$tag));
        return $links;
    }
    /**
     * Normalizes the user-entered tags.
     */
    public function normalizeTags($attribute,$params)
    {
        $this->tags=HopamTag::array2string(array_unique(HopamTag::string2array($this->tags)));
    }
    protected function beforeSave(){
        if($this->isNewRecord){
            $this->user_id = Yii::app()->user->id;
        }
        return parent::beforeSave();
    }
    /**
     * This is invoked after the record is saved.
     */
    protected function afterSave()
    {
        HopamTag::model()->updateFrequency($this->_oldTags, $this->tags);
        Ban::model()->updateFrequency($this->_oldBans, $this->ban_artist);
        if($this->isNewRecord)
            $this->create_time = time();
        else
            $this->update_time = time();
        parent::afterSave();

    }
    /**
     * This is invoked after the record is deleted.
     */
    protected function afterDelete()
    {
        parent::afterDelete();
        //Comment::model()->deleteAll('post_id='.$this->id);
        HopamTag::model()->updateFrequency($this->tags, '');
        Ban::model()->updateFrequency($this->ban_artist, '');
    }
    /**
     * This is invoked when a record is populated with data from a find() call.
     */
    protected function afterFind()
    {
        parent::afterFind();
        $this->_oldTags=$this->tags;
        $this->_oldBans=$this->ban_artist;
    }

    public function getMark()
    {
        if ($this->rateHopams) {
            $marks = 0;
            foreach ($this->rateHopams as $rate) {
                $marks += $rate->marks;
            }

            return ceil($marks / $this->totalRate);
        }
        return 1;
    }

    public function getHtmlMark()
    {
        $mark = $this->mark;
        $out = '';
        for ($i = 1; $i <= $mark; $i++)
            $out .= '<img width="7" height="7" src="'.Yii::app()->baseUrl.'/images/dotted.png" />';
        return $out;
    }

    /**
     * @param $comment Comments
     * @return mixed
     */
    public function addComment($comment)
    {
        if(Yii::app()->params['commentNeedApproval'])
            $comment->status=2;
        else
            $comment->status=1;
        $comment->hopam_id=(int)$this->id;
        $comment->user_id = (int) Yii::app()->user->id;

        return $comment->save() ;
    }
    public function getUrl()
    {
        return Yii::app()->createUrl('hopam/view', array(
            'id'=>$this->id,
            'title'=>Yii::app()->func->safeTitle($this->title),
        ));
    }
}