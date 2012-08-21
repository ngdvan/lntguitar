<?php
/**
 * User: thanhdx
 * Date: 6/7/12
 * Time: 3:08 AM
 * @file SongController.php
 */
class SongController extends Controller
{
    public $layout="song";
    public function actionIndex()
    {
        $model = new Song();
        $model->status = 1;
        if(isset($_GET['tid']))
            $model->tid = $_GET['tid'];

        if(isset($_GET['c']))
            $model->title = $_GET['c'];

        $this->render('index', array(
            'model' => $model,));
    }

    public function actionView(){
        $this->layout = 'hopam_detail';

        $hopam = Song::model()->findByPk($_GET['id']);
        $hopam->view += 1;
        $hopam->update(array('view'));

        //$comment = $this->newComment($hopam);

        $cs = Yii::app()->getClientScript();
        $js = $this->generateJs();
        $cs->registerScript('sharebox', $js, CClientScript::POS_READY);

        $this->render('view',array('hopam'=>$hopam)); //,'comment'=>$comment
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

    public function actionLike($id)
    {
        $ok = false;
        if (!Yii::app()->user->isGuest) {
            $criteria = new CDbCriteria();
            $criteria->addCondition('song_id=' . $id);
            $criteria->addCondition('user_id=' . Yii::app()->user->id);
            $exist = LikeSong::model()->count($criteria);
            $msg = 'Bạn đã like rồi!';
            if (!$exist) {
                $like = new LikeSong();
                $like->song_id = $id;
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

    public function actionRequirement()
    {
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->baseUrl . '/css/requirement.css', 'screen');

        $model=new Requirement;

        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='requirement-requirement-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */

        if(isset($_POST['Requirement']))
        {
            $model->attributes=$_POST['Requirement'];
            if($model->validate())
            {
                // form inputs are valid, do something here
                return;
            }
        }
        $this->render('requirement',array('model'=>$model));
    }
}
