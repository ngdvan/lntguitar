<?php
/**
 * User: thanhdx
 * Date: 6/10/12
 * Time: 11:16 PM
 * @file UserController.php
 */
class UserController extends Controller
{

    public function actionView(){
        $this->layout = 'profile';
        $username = $_GET['username'];
        $user = XfUser::model()->find("username='".$username."'");

        $db = Yii::app()->db;
        $sql = "SELECT v.id,v.title,v.body,v.image,v.link_youtube,v.view,t.username FROM {{video}} v INNER JOIN {{teacher}} t ON v.teacher_id = t.id WHERE v.status = 1 AND t.username = '{$username}' ORDER BY v.id DESC LIMIT 0,4";
        $cmd = $db->createCommand($sql);
        $dataReader = $cmd->query();
        $video = array();
        foreach($dataReader as $item){
            $video[] = $item;
        }
        $this->render('view',array('user'=>$user,'video'=>$video));
    }
}
