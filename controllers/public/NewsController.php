<?php
/**
 * User: thanhdx
 * Date: 6/7/12
 * Time: 12:53 AM
 * @file PageController.php
 */
class NewsController extends Controller
{
    public $layout = "news";
    public function actionDetail(){
        $news = News::model()->findByPk($_GET['id']);
        $news->view +=1;
        $news->update(array('view'));
        $tid = null;
        if(isset($_GET['tid'])){
            $tid = $_GET['tid'];
        }
        $id = null;
        if(isset($_GET['id']))
            $id = $_GET['id'];
        $this->render('view',array('news'=>$news,'tid'=>$tid,'id'=>$id));
    }

    public function actionList(){
        if(isset($_GET['tid'])){
            $news = News::model()->find('term_id='.$_GET['tid']);
            $tid = null;
            if(isset($_GET['tid'])){
                $tid = $_GET['tid'];
            }
            $id = null;
            if(isset($_GET['id']))
                $id = $_GET['id'];
            $this->render('view',array('news'=>$news,'tid'=>$tid,'id'=>$id));
        }else{
            $this->redirect("/");
        }


    }
}
