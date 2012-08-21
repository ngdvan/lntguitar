<?php

Yii::import('application.models._base.BaseVideo');

class Video extends BaseVideo
{
    private $_oldTags;
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function beforeSave(){
        if($this->isNewRecord){
            $this->create_time = $this->update_time = time();
            $this->user_id = Yii::app()->user->id;
        }else{
            $this->update_time = time();
        }

        return parent::beforeSave();
    }
    /**
     * @return array a list of links that point to the post list filtered by every tag of this post
     */
    public function getTagLinks()
    {
        $links=array();
        foreach(VideoTag::string2array($this->tags) as $tag)
            $links[]=CHtml::link(CHtml::encode($tag), array('video/index', 'tag'=>$tag));
        return $links;
    }
    /**
     * Normalizes the user-entered tags.
     */
    public function normalizeTags($attribute,$params)
    {
        $this->tags=VideoTag::array2string(array_unique(VideoTag::string2array($this->tags)));
    }
    /**
     * This is invoked after the record is saved.
     */
    protected function afterSave()
    {
        parent::afterSave();
        VideoTag::model()->updateFrequency($this->_oldTags, $this->tags);
    }
    /**
     * This is invoked after the record is deleted.
     */
    protected function afterDelete()
    {
        parent::afterDelete();
        //Comment::model()->deleteAll('post_id='.$this->id);
        VideoTag::model()->updateFrequency($this->tags, '');
    }
    /**
     * This is invoked when a record is populated with data from a find() call.
     */
    protected function afterFind()
    {
        parent::afterFind();
        $this->_oldTags=$this->tags;
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
        $comment->video_id=(int)$this->id;
        $comment->user_id = (int) Yii::app()->user->id;

        return $comment->save() ;
    }
}