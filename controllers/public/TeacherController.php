<?php
/**
 * User: thanhdx
 * Date: 6/1/12
 * Time: 12:48 AM
 * @file TeacherController.php
 */
class TeacherController extends Controller
{
    public $layout = 'teacher';
    private $_assetsUrl;
    private $debug = true;

    public function actionView()
    {
        /**
         * @var teacher Teacher
         */
        $teacher = Teacher::model()->findByPk((int)$_GET['id']);
        $teacher->view += 1;
        $teacher->update(array('view'));
        $this->registerScripts();
        $this->render('view', array('teacher' => $teacher));
    }

    public function actionIndex()
    {
        $criteria = new CDbCriteria(array(
            'condition' => 'status=1',
            'order' => 'pos ASC',
            'limit' => '0,1',
        ));

        $teacher = Teacher::model()->find($criteria);
        $teacher->view += 1;
        $teacher->update(array('view'));
        $this->registerScripts();
        $this->render('view', array('teacher' => $teacher));
    }

    /**
     * Publishes the module assets path.
     * @return string the base URL that contains all published asset files of Rights.
     */
    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null) {
            $assetsPath = Yii::getPathOfAlias('webroot.js.bxSlider');
            //var_dump($assetsPath);die;
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
        /*$('#photos').bxSlider({
                                       displaySlideQty:3,
                                        moveSlideQty: 1
                                      });*/
        $js = "
                jQuery('#photos').jcarousel();
                $('.colorbox1').colorbox({rel:'colorbox1'});
                                      ";
        return $js;
    }

    public function registerScripts()
    {
        // Get the url to the module assets
        //$assetsUrl1 = Lnt::getAssets('webroot.js.bxSlider', true);
        $assetsUrl2 = Lnt::getAssets('webroot.js.colorbox', true);
        $assetsUrl3 = Lnt::getAssets('webroot.js.jcarousel', true);

        // Register the necessary scripts
        /**
         * @var $cs CClientScript;
         */
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        /*$cs->registerScriptFile($assetsUrl1 . '/jquery.bxSlider.min.js');
        $cs->registerCssFile($assetsUrl1 . '/bxslider.css');*/

        $cs->registerScriptFile($assetsUrl2 . '/jquery.colorbox-min.js');
        $cs->registerCssFile($assetsUrl2 . '/colorbox.css');

        $cs->registerScriptFile($assetsUrl3 . '/jquery.jcarousel.min.js');
        $cs->registerCssFile($assetsUrl3 . '/skins/tango/skin.css');
        $cs->registerScript('slide_', $this->getScriptCode());

    }

    public function actionLike($id)
    {
        $ok = false;
        if (!Yii::app()->user->isGuest) {
            $criteria = new CDbCriteria();
            $criteria->addCondition('id=' . $id);
            $criteria->addCondition('user_id=' . Yii::app()->user->id);
            $exist = LikeTeacher::model()->count($criteria);
            $msg = 'Bạn đã like rồi!';
            if (!$exist) {
                $like = new LikeTeacher();
                $like->teacher_id = $id;
                $like->user_id = Yii::app()->user->id;
                if ($like->save()) {
                    $ok = true;
                    $msg = 'Thank you!';
                }
            }
        } else {
            $ok = false;
            $msg = 'Bạn cần phải đăng nhập!';
        }

        header('Content-Type: application/json');
        echo CJSON::encode(array('ok' => $ok, 'msg' => $msg));
    }
}
