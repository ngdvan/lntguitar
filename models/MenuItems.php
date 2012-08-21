<?php

Yii::import('application.models._base.BaseMenuItems');

class MenuItems extends BaseMenuItems
{
    private $childs;
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function getListed()
    {
        $this->_getChilds();
        $subitems = array();
        if ($this->childs) {
            foreach ($this->childs as $child) {
                /**
                 * @var $child Hierarchy
                 */
                $subitems[] = $child->getListed();
            }
        }

        
        if ($this->router) {
            $url = array($this->router);
        } elseif ($this->url) {
            $url = $this->url;
        }

        $returnarray = array();
        if (isset($url) && $url) {
            $returnarray['label'] = $this->title;
            $returnarray['url'] = $url;
        } else {
            $returnarray['label'] = $this->title;
        }

        if ($this->is_backend) {
            $returnarray['visible'] = !Yii::app()->user->isGuest && Yii::app()->user->checkAccess("admin");
        }

        if ($subitems != array()) {
            $returnarray = array_merge($returnarray, array('items' => $subitems));
        }
        return $returnarray;
    }

    public function getOptions()
    {
        $this->_getChilds();
        $subitems = array();
        if ($this->childs) foreach ($this->childs as $child) {
            /**
             * @var $child Hierarchy
             */
            $subitems[] = $child->getOptions();
        }
        $returnarray = array($this->id => $this->title);
        if ($subitems != array()) {
            $returnarray = array_merge($returnarray, $subitems);
        }

        return $returnarray;
    }

    public function htmlOptionData()
    {
        $data = $this->findAll();
        $items = array(0 => '--None--');
        if ($data) {
            foreach ($data as $pitem) {
                $items[$pitem->id] = $pitem->title;
            }
        }
        return $items;
    }

    private function _getChilds()
    {
        if (!$this->isNewRecord) {
            $criteria = new CDbCriteria(array('condition' => 'parent = ' . $this->id, 'order' => 'sort ASC'));
            $this->childs = $this->findAll($criteria);
        }

    }
}