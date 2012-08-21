<?php
/**
 * User: thanhdx
 * Date: 5/27/12
 * Time: 1:22 PM
 * @file VideoController.php
 */
class VideoController extends Controller
{
    public $layout = 'video';

    public function actionView()
    {
        if (isset($_GET['id'])) {
            $video = Video::model()->findByPk($_GET['id']);
            //var_dump($video->user_id);die;
            $video->view += 1;
            $video->update(array('view'));

            //$video->user = XfUser::model()->find("user_id=".$video->user_id);
            $comment = $this->newComment($video);

            $cs = Yii::app()->getClientScript();
            $js = $this->generateJs();
            $cs->registerScript('sharebox', $js, CClientScript::POS_READY);

            /*$xf = new XfAuthentication();
            $user = $xf->getUser();
            var_dump($user);*/
            
            $this->render('view', array('video' => $video, 'comment' => $comment));
        } else {
            $this->redirect($this->createUrl('index'));
        }
    }

    protected function newComment($video)
    {
        $comment = new VideoComment;
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment-form') {
            echo CActiveForm::validate($comment);
            Yii::app()->end();
        }
        if (isset($_POST['VideoComment'])) {
            $comment->attributes = $_POST['VideoComment'];
            $comment->video_id = $video->id;

            if ($video->addComment($comment)) {
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
            $criteria->addCondition('id=' . $id);
            $criteria->addCondition('user_id=' . Yii::app()->user->id);
            $exist = LikeVideo::model()->count($criteria);
            $msg = 'Bạn đã like rồi!';
            if (!$exist) {
                $like = new LikeVideo();
                $like->video_id = $id;
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

    public function actionIndex()
    {
        $criteria = new CDbCriteria(array(
            'condition' => 'status=1',
            'order' => 'create_time DESC',
            'limit'=>'0,20',
        ));
        //$criteria->addCondition('`type` =`video`');
        $dataProvider = new CActiveDataProvider('Video', array(
            'pagination' => array(
                'pageSize' => Yii::app()->params['postsPerPage'],
            ),
            'criteria' => $criteria,
        ));
        $criteria2 = new CDbCriteria(array(
            'condition' => 'status=1',
            'order' => 'view DESC',
            'limit'=>'0,20',
        ));
        $dataProvider2 = new CActiveDataProvider('Video', array(
            'pagination' => array(
                'pageSize' => Yii::app()->params['postsPerPage'],
            ),
            'criteria' => $criteria2,
        ));

        $criteria3 = new CDbCriteria(array(
            'condition' => 't.status=1',
            'limit'=>'0,20',
        ));
        //$criteria3->join = ' INNER JOIN {{video}} v ON v.nid = t.nid';
        //$criteria3->order = 'tags DESC';
        $criteria3->order = '(SELECT count(*) FROM lnt_like_video l
                     WHERE l.video_id = t.id) DESC';

        $dataProvider3 = new CActiveDataProvider('Video', array(
            'pagination' => array(
                'pageSize' => Yii::app()->params['postsPerPage'],
            ),
            'criteria' => $criteria3,
        ));

        $cs = Yii::app()->getClientScript();
        $js = $this->generateJsTab();
        $cs->registerScript('vl_tab', $js, CClientScript::POS_READY);

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'dataProvider2' => $dataProvider2,
            'dataProvider3' => $dataProvider3,
        ));
    }

    public function actionList()
    {
        $criteria = new CDbCriteria(array(
            'condition' => 't.status=1',
            //'order' => 'v.update_time DESC',
        ));

        if (isset($_GET['tag']))
            $criteria->addSearchCondition('tags', $_GET['tag']);
        $title = 'Tất cả Video';
        switch ($_GET['filter']) {
            case 'latest':
                $criteria->order = 't.create_time DESC';
                $title = 'Video mới nhất';
                break;
            case 'top_view':
                $criteria->order = 't.view DESC';
                $title = 'Xem nhiều nhất';
                break;
            case 'top_like':
                //$criteria->join = ' INNER JOIN {{like_video}} l ON l.video_id = t.id';
                $criteria->order = '(SELECT count(id) FROM lnt_like_video l
                     WHERE l.video_id = t.id) DESC';
                $title = 'Bình chọn nhiều nhất';
                break;

        }

        $dataProvider = new CActiveDataProvider('Video', array(
            'pagination' => array(
                'pageSize' => Yii::app()->params['postsPerPage'],
            ),
            'criteria' => $criteria,
        ));
        /*if($_GET['filter']){
            $sort = new CSort();
            $sort->attributes = array(
                'linkCountSort' => array(
                    'asc' => '(SELECT count(id) FROM {like}
                     WHERE nid = t.author_id) ASC',
                    'desc' => '(SELECT count(posts.id) FROM posts
                     WHERE posts.author_id = t.author_id) DESC',
                ));
            $dataProvider->sort = $sort;
        }*/

        $this->render('list', array(
            'dataProvider' => $dataProvider,
            'title' => $title,
        ));
    }

    public function actionCatlist()
    {
        $criteria = new CDbCriteria(array(
            'condition' => 't.status=1',
            'order' => 't.create_time DESC',
        ));

        if (isset($_GET['catid'])){
            $criteria->addSearchCondition('term_id', $_GET['catid']);
            /**
             * @var $cat Term
             */
            $cat = Term::model()->findByPk($_GET['catid']);
            $title= $cat->name;

            $subTerms = Term::model()->findAll('parent='.$_GET['catid']);
            if($subTerms){
                $sTerms = array();
                foreach($subTerms as $term){
                    $sTerms[] = $term->id;
                }
                $criteria->addInCondition("term_id",$sTerms,'OR');
            }
        }else{
            $title = 'Tất cả Video';
        }

        $dataProvider = new CActiveDataProvider('Video', array(
            'pagination' => array(
                'pageSize' => Yii::app()->params['postsPerPage'],
            ),
            'criteria' => $criteria,
        ));
        /*if($_GET['filter']){
            $sort = new CSort();
            $sort->attributes = array(
                'linkCountSort' => array(
                    'asc' => '(SELECT count(id) FROM {like}
                     WHERE nid = t.author_id) ASC',
                    'desc' => '(SELECT count(posts.id) FROM posts
                     WHERE posts.author_id = t.author_id) DESC',
                ));
            $dataProvider->sort = $sort;
        }*/

        $this->render('list', array(
            'dataProvider' => $dataProvider,
            'title' => $title,
        ));
    }

    public function  actionTag($tag)
    {
        $criteria = new CDbCriteria(array(
            'condition' => 'status=1',
            'order' => 'update_time DESC',
        ));
         $criteria->addCondition('tags = "' . $tag . '"');
        $dataProvider = new CActiveDataProvider('Video', array(
            'pagination' => array(
                'pageSize' => Yii::app()->params['postsPerPage'],
            ),
            'criteria' => $criteria,
        ));
        $this->render('list', array(
            'dataProvider' => $dataProvider,
            'title' => 'Tag: ' . $tag,
        ));
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

    function generateJsTab()
    {
        $nl = "\n";
        $js = '';
        $js .= '$("#tab1").click(' . $nl;
        $js .= '    function(){ ' . $nl;
        $js .= '        if($("#c_tab1").is("::hidden")){' . $nl;
        $js .= '            $("#c_tab1").show();' . $nl;
        $js .= '            $("#c_tab2").hide();' . $nl;
        $js .= '        }' . $nl;
        $js .= '        $("#tab1").addClass("arrow_left_active");' . $nl;
        $js .= '        $("#tab2").addClass("arrow_left");' . $nl;
        $js .= '        $("#tab2").removeClass("arrow_left_active");' . $nl;
        $js .= '        $("#tab1").removeClass("arrow_left");' . $nl;
        $js .= '    }' . $nl;
        $js .= ');';

        $js .= '$("#tab2").click(' . $nl;
        $js .= '    function(){ ' . $nl;
        $js .= '        if($("#c_tab2").is("::hidden")){' . $nl;
        $js .= '            $("#c_tab2").show();' . $nl;
        $js .= '            $("#c_tab1").hide();' . $nl;
        $js .= '        }' . $nl;
        $js .= '        $("#tab2").addClass("arrow_left_active");' . $nl;
        $js .= '        $("#tab1").addClass("arrow_left");' . $nl;
        $js .= '        $("#tab2").removeClass("arrow_left");' . $nl;
        $js .= '        $("#tab1").removeClass("arrow_left_active");' . $nl;
        $js .= '    }' . $nl;
        $js .= ');';

        return $js;
    }
}
