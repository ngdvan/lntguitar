<?php
/**
 * User: thanhdx
 * Date: 6/7/12
 * Time: 3:08 AM
 * @file SongController.php
 */
class HopamController extends Controller
{
    private $_assetsUrl;
    private $debug = true;
    public $layout = "hopam";

    public function actionIndex()
    {
        $model = new Hopam('search');
        $model->status = 1;
        if (isset($_GET['key_type']) && isset($_GET['keyword'])) {
            if ($_GET['key_type'] == 1) {
                $model->title = $_GET['keyword'];
            } elseif ($_GET['key_type'] == 2) {
                $model->ban_artist = $_GET['keyword'];
            } else {
                //$model->title = $_GET['keyword'];
                //$model->ban_artist = $_GET['keyword'];
            }
        } else {
            if (isset($_GET['tid']))
                $model->tid = $_GET['tid'];

            if (isset($_GET['c']))
                $model->title = $_GET['c'];
        }


        //var_dump($model->attributes);
        $this->render('index', array(
            'model' => $model));
    }

    public function actionView()
    {
        $this->layout = 'hopam_detail';

        $hopam = Hopam::model()->findByPk($_GET['id']);
        $hopam->view += 1;
        $hopam->update(array('view'));

        $comment = $this->newComment($hopam);

        $cs = Yii::app()->getClientScript();
        $js = $this->generateJs();
        $cs->registerScript('sharebox', $js, CClientScript::POS_READY);

//        $assetsUrl = $this->getAssetsUrl();
        $assetsUrl = '/js/transposer';
        $cs->registerCssFile($assetsUrl . '/jquery.transposer.css', 'screen');
        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile($assetsUrl . '/jquery-ui.js');
        $cs->registerScriptFile($assetsUrl . '/jquery.ui.touch-punch.js');
        $cs->registerScriptFile($assetsUrl . '/jquery_chords.js');
        $cs->registerScriptFile($assetsUrl . '/jquery.transposer.js');

        $xmlFile = Yii::getPathOfAlias('webroot') . $hopam->lyrics;
        //var_dump($xmlFile);
        $xml = simplexml_load_file($xmlFile);
        $dataRows = $xml->DataRows->DataRow;
        $lyrics = array();
        $pattern = array("+", "|");
        foreach ($dataRows as $row) {
            $row = preg_replace("/\+/i", "", (string)$row);
//            $row = preg_replace("/\|/i","",(string)$row);
            $lyrics[] = $row;
        }

        $chords = $xml->Transposes->Transpose->Keys->Key->Chords->Chord;
        $key = (string)$xml->Transposes->Transpose->Keys->Key->Name;
        $key = substr($key, 0, strpos($key, " "));
        $chordList = array();
        foreach ($chords as $chord) {
            $apps = $chord->Apps->App;
            foreach ($apps as $app) {
                $ch = $app->Chord;
                $chordList[strtolower($ch)] = preg_replace('/\//', "Slash", $ch);
                $id = $app->AppID;
                $locs = $app->Locs->Loc;
                foreach ($locs as $loc) {
//                var_dump((string)$loc->Row);die;
                    $row = (string)$loc->Row;
                    $col = (string)$loc->Col;
                    $line = CHtml::encode($lyrics[$row]);
                    $arrLine = explode(" ", $line);
                    if ($id > 1) // && !preg_match('/\//',$ch)
                        $arrLine[$col] = "[" . $ch . "." . $id . "]" . $arrLine[$col];
                    else
                        $arrLine[$col] = "[" . $ch . "]" . $arrLine[$col];
                    $lyrics[$row] = implode(" ", $arrLine);
                }
            }

        }

        $hopam->lyrics = implode("\n", $lyrics);
//        var_dump($hopam->lyrics);die;
        $this->render('view', array('hopam' => $hopam, 'chord_list' => $chordList, 'comment' => $comment, 'key' => $key));
    }

    protected function newComment($hopam)
    {

        $comment = new HopamComment();
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment-form') {
            echo CActiveForm::validate($comment);
            Yii::app()->end();
        }
        if (isset($_POST['HopamComment'])) {
            //die('111');
            $comment->attributes = $_POST['HopamComment'];
            $comment->hopam_id = $hopam->id;
            //var_dump($comment);die;
            if ($hopam->addComment($comment)) {
                if ($comment->status == 1)
                    Yii::app()->user->setFlash('commentSubmitted', 'Cảm ơn bạn đã bình luận.');
                $this->refresh();
            }
        }
        return $comment;
    }

    public function actionLike($id)
    {
        $ok = false;
        if (!Yii::app()->user->isGuest) {
            $criteria = new CDbCriteria();
            $criteria->addCondition('hopam_id=' . $id);
            $criteria->addCondition('user_id=' . Yii::app()->user->id);
            $exist = LikeHopam::model()->count($criteria);
            $msg = 'Bạn đã like rồi!';
            if (!$exist) {
                $like = new LikeHopam();
                $like->hopam_id = $id;
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

    function generateJs()
    {
        $nl = "\n";
        $js = '';
        $js .= '$(".fan_share").click(' . $nl;
        $js .= '    function(){ ' . $nl;
        $js .= '        if($("#share_box").is("::hidden")){' . $nl;
        $js .= '            $("#share_box").show();' . $nl;
        $js .= '        }else{' . $nl;
        $js .= '            $("#share_box").hide();' . $nl;
        $js .= '        }' . $nl;
        $js .= '    }' . $nl;
        $js .= ');';

        $js .= '$("#share_box input").click(function(){$(this).focus(); $(this).select()});';
        return $js;
    }


    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null) {
            $assetsPath = Yii::getPathOfAlias('webroot.js.transposer');
            // We need to republish the assets if debug mode is enabled.
            if ($this->debug === true)
                $this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath, false, -1, true);
            else
                $this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath);
        }

        return $this->_assetsUrl;
    }
}
