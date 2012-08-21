<?php

Yii::import('application.models._base.BaseSong');

class Song extends BaseSong
{
    private $_oldBans;
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function normalizeTags($attribute,$params)
    {
        $this->ban_artist=SongBans::array2string(array_unique(HopamTag::string2array($this->tags)));
    }

    public function beforeSave()
    {
        SongBans::model()->updateFrequency($this->_oldBans, $this->ban_artist);
        if ($this->isNewRecord) {
            $this->create_time = $this->update_time = time();
            $this->user_id = Yii::app()->user->id;
        } else {
            $this->update_time = time();
        }
        return parent::beforeSave();
    }
    /**
     * This is invoked after the record is deleted.
     */
    protected function afterDelete()
    {
        parent::afterDelete();
        SongBans::model()->updateFrequency($this->ban_artist, '');
    }

    /**
     * This is invoked when a record is populated with data from a find() call.
     */
    protected function afterFind()
    {
        parent::afterFind();
        $this->_oldBans=$this->ban_artist;
    }

    public function getMark()
    {
        if ($this->rateSongs) {
            $marks = 0;
            foreach ($this->rateSongs as $rate) {
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
}