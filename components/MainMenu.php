<?php
class MainMenu extends CMenu
{
	private $nljs;
	public function init()
	{
		if(!$this->getId(false))
			$this->setId('nav');
		
		// add the script
		$cs = Yii::app()->getClientScript();
		$cs->registerCoreScript('jquery');
		
		$this->nljs = "\n";
		$this->items=$this->cssParentItems($this->items);
		$js = $this->createJsCode();
		$cs->registerScript('mainmenu_'.$this->getId(), $js, CClientScript::POS_READY);
		
		parent::init();
	}
	
	/**
	 * The javascript needed
	 */
	protected function createJsCode()
	{
		$js='';
		$js .= '  $("#nav li").hover(' . $this->nljs;
		$js .= '    function () {' . $this->nljs;
		$js .= '      if ($(this).hasClass("parent")) {' . $this->nljs;
		$js .= '        $(this).addClass("over");' . $this->nljs;
		$js .= '      }' . $this->nljs;
		$js .= '    },' . $this->nljs;
		$js .= '    function () {' . $this->nljs;
		$js .= '      $(this).removeClass("over");' . $this->nljs;
		$js .= '    }' . $this->nljs;
		$js .= '  );' . $this->nljs;
		return $js;
	}
	
	/**
	 * Give the last items css 'parent' style
	 */
	protected function cssParentItems($items)
	{
		foreach($items as $i=>$item)
		{
			if(isset($item['items']))
			{
				if(isset($item['itemOptions']['class']))
					$items[$i]['itemOptions']['class'].=' parent';
				else
					$items[$i]['itemOptions']['class']='parent';
				 
				$items[$i]['items']=$this->cssParentItems($item['items']);
			}
		}
	
		return array_values($items);
	}
	
	protected function renderMenuRecursive($items)
	{
		$count=0;
		$n=count($items);
        $crController = Yii::app()->getController();
        $crControllerId = $crController->getId();
		foreach($items as $item)
		{
			$count++;
			$options=isset($item['itemOptions']) ? $item['itemOptions'] : array();
			$class=array();
            //var_dump($item);die;
            if(isset($item['url'])&&$item['url']){
                //var_dump($item);die;
                //$item['active'] = true;
            }

			if($item['active'] && $this->activeCssClass!='')
				$class[]=$this->activeCssClass;
			if($count===1 && $this->firstItemCssClass!==null)
				$class[]=$this->firstItemCssClass;
			if($count===$n && $this->lastItemCssClass!==null)
				$class[]=$this->lastItemCssClass;
			if($this->itemCssClass!==null)
				$class[]=$this->itemCssClass;
			if($class!==array())
			{
				if(empty($options['class']))
					$options['class']=implode(' ',$class);
				else
					$options['class'].=' '.implode(' ',$class);
			}
	
			echo CHtml::openTag('li', $options);
	
			$menu=$this->renderMenuItem($item);
			if(isset($this->itemTemplate) || isset($item['template']))
			{
				$template=isset($item['template']) ? $item['template'] : $this->itemTemplate;
				echo strtr($template,array('{menu}'=>$menu));
			}
			else
				echo $menu;
	
			if(isset($item['items']) && count($item['items']))
			{
				echo $this->nljs.CHtml::openTag("div",array('id'=>'nav_sub')).$this->nljs;
				echo $this->nljs.CHtml::openTag("div",array('id'=>'nav_sub_left')).$this->nljs;
				echo $this->nljs.CHtml::openTag("div",array('id'=>'nav_sub_center')).$this->nljs;
				echo $this->nljs.CHtml::openTag("div",array('id'=>'nav_sub_right')).$this->nljs;
				echo "\n".CHtml::openTag('ul',isset($item['submenuOptions']) ? $item['submenuOptions'] : $this->submenuHtmlOptions)."\n";
				$this->renderMenuRecursive($item['items']);
				echo CHtml::closeTag('ul')."\n";
				echo CHtml::closeTag("div").$this->nljs;
				echo CHtml::closeTag("div").$this->nljs;
				echo CHtml::closeTag("div").$this->nljs;
			}
	
			echo CHtml::closeTag('li')."\n";
		}
	}

    protected function isItemActive($item,$route)
    {

        if(isset($item['url']) && is_array($item['url']) && !strcasecmp(trim($item['url'][0],'/'),$route))
        {
            //var_dump($route);die;
            //var_dump(trim($item['url'][0],'/'));
            if(count($item['url'])>1)
            {
                foreach(array_splice($item['url'],1) as $name=>$value)
                {
                    if(!isset($_GET[$name]) || $_GET[$name]!=$value)
                        return false;
                }
            }
            return true;
        }elseif(isset($item['url']) && is_array($item['url'])){
            $crt = explode("/",$route);
            $cu = explode("/",trim($item['url'][0],'/'));
            if($crt[0] == $cu[0]){
                if(($cu[0]=='training' && $cu[1]!='register' && $crt[1] != 'register') || $cu[0]=='hopam' || $cu[0]=='teacher'|| $cu[0]=='video'|| ($cu[0]=='song'&& $cu[1]!='requirement'&& $crt[1]!='requirement')){
                    return true;
                }
            }
        }elseif(isset($item['url']) && !is_array($item['url'])){
            //$cu = explode("/",trim($item['url'][0],'/'));
            if($route == 'page/view' && isset($_GET['id']) && in_array($_GET['id'],array(1,2,3)) && preg_match("/\/page\/.*(".$_GET['id']."\.html)/",$item['url'])){
                //var_dump($route);
                return true;
            }
        }
        return false;
    }
}