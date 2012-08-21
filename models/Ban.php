<?php

Yii::import('application.models._base.BaseBan');

class Ban extends BaseBan
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function suggestTags($keyword, $limit = 20)
    {
        $tags = $this->findAll(array(
            'condition' => 'title LIKE :keyword',
            'order' => 'frequency DESC, title',
            'limit' => $limit,
            'params' => array(
                ':keyword' => '%' . strtr($keyword, array('%' => '\%', '_' => '\_', '\\' => '\\\\')) . '%',
            ),
        ));
        $names = array();
        foreach ($tags as $tag)
            $names[] = $tag->title;
        return $names;
    }
	
	public static function string2array($tags)
    {
        return preg_split('/\s*,\s*/', trim($tags), -1, PREG_SPLIT_NO_EMPTY);
    }

    public static function array2string($tags)
    {
        return implode(', ', $tags);
    }

    public function updateFrequency($oldTags, $newTags)
    {
        $oldTags = self::string2array($oldTags);
        $newTags = self::string2array($newTags);
        $this->addTags(array_values(array_diff($newTags, $oldTags)));
        $this->removeTags(array_values(array_diff($oldTags, $newTags)));
    }

    public function addTags($tags)
    {
        $criteria = new CDbCriteria;
        $criteria->addInCondition('title', $tags);
        $this->updateCounters(array('frequency' => 1), $criteria);
        foreach ($tags as $name) {
            if (!$this->exists('title=:name', array(':name' => $name))) {
                $tag = new Ban;
                $tag->title = $name;
                $tag->frequency = 1;
                $tag->save();
            }
        }
    }

    public function removeTags($tags)
    {
        if (empty($tags))
            return;
        $criteria = new CDbCriteria;
        $criteria->addInCondition('title', $tags);
        $this->updateCounters(array('frequency' => -1), $criteria);
        $this->deleteAll('frequency<=0');
    }
}