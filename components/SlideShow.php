<?php
/**
 * User: thanhdx
 * Date: 7/2/12
 * Time: 10:13 PM
 * @file SlideShow.php
 */
class SlideShow extends CWidget
{
    private $_assetsUrl;
    private $debug = true;

    public function init()
    {
        $this->registerScripts();
    }

    public function run()
    {
        if ($this->beginCache("slideshow", array('duration' =>0))) {
            $criteria = new CDbCriteria();
            $criteria->addCondition('status=1');
            $criteria->order = 'pos DESC';
            $criteria->limit = 20;

            $items = SlideManager::model()->findAll($criteria);
            $slide = '';
            if ($items) {
                $i=0;
                foreach ($items as $item) {
                    //<img src="<?php echo Yii::app()->baseUrl; /images/img_slice_21.jpg" title="Xin chao"/>
                    $imgclass = $i ? "notshow":"";
                    $imgUrl = Lnt::createImage($item->image,528, 272);
                    $slide .= CHtml::image(
                        $imgUrl, 
                        $item->title, 
                        array('title' => CHtml::link($item->title, $item->url), 'width' => 528, 'height' => 272,'class'=>$imgclass)
                        );
                    $i++;
                }
            }
            echo $slide;
            $this->endCache();
        }

    }


    public function registerScripts()
    {
        // Get the url to the module assets
        $assetsUrl = $this->getAssetsUrl();

        // Register the necessary scripts
        /**
         * @var $cs CClientScript;
         */
        $cs = Yii::app()->getClientScript();
        
        $cs->registerCssFile($assetsUrl . '/themes/default/default.css', 'screen');
        $cs->registerCssFile($assetsUrl . '/nivo-slider.css', 'screen');
        //$cs->registerCssFile($assetsUrl . '/style.css', 'screen');
        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile($assetsUrl . '/jquery.nivo.slider.pack.js');
        $cs->registerScript('slide_', $this->getScriptCode(),CClientScript::POS_LOAD);

    }

    /**
     * Publishes the module assets path.
     * @return string the base URL that contains all published asset files of Rights.
     */
    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null) {
            $assetsPath = Yii::getPathOfAlias('webroot.js.slide');
            // We need to republish the assets if debug mode is enabled.
            if ($this->debug === true)
                $this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath, false, -1, true);
            else
                $this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath);
        }

        return $this->_assetsUrl;
    }

    function getScriptCode()
    {
        /*
		$js = "$(window).load(function() {
	                $('#slide').nivoSlider({controlNav: false,prevText:'',nextText: '',directionNavHide:false});
                });
              ";*/
			  $js = "$('#slide').find('img').show(); $('#slide').nivoSlider({controlNav: false,prevText:'',nextText: '',directionNavHide:false});";

        return $js;
    }
}
