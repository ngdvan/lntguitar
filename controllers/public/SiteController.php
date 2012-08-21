<?php

class SiteController extends Controller
{
    public $layout = 'home';

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $appItems = array();

        $db = Yii::app()->db;
        
        $sql = "SELECT v.id,v.title,v.image,v.link_youtube as youtube,v.view,u.user_id,u.username FROM {{video}} v INNER JOIN xf_user u ON v.user_id = u.user_id WHERE v.status = 1 ORDER BY v.id DESC LIMIT 0,4";
        $cmd = $db->createCommand($sql);
        $dataReader = $cmd->query();
        foreach($dataReader as $item){
            $item['url'] = $this->createUrl('/video/view',array('id'=>$item['id'],'title'=>Lnt::safeTitle($item['title'])));
            $appItems[] = $item;
        }
        
        /*$sql2 = "SELECT s.title,s.image,s.id,s.view,s.embed_code as youtube,u.user_id,u.username FROM {{song}} s INNER JOIN xf_user u ON s.user_id = u.user_id WHERE s.status = 1 ORDER BY s.create_time DESC LIMIT 0,2";
        $cmd2 = $db->createCommand($sql2);
        $dataReader2 = $cmd2->query();
        foreach($dataReader2 as $item){
            $item['url'] = $this->createUrl('/song/view',array('id'=>$item['id'],'title'=>Lnt::safeTitle($item['title'])));
            $appItems[] = $item;
        }*/

        //var_dump($appItems);die;
        $sql2 = "SELECT s.title,s.image,s.id,s.view,s.embed_code as youtube,u.user_id,u.username FROM {{hopam}} s INNER JOIN xf_user u ON s.user_id = u.user_id WHERE s.status = 1 ORDER BY s.create_time DESC LIMIT 0,2";
        $cmd2 = $db->createCommand($sql2);
        $dataReader2 = $cmd2->query();
        foreach($dataReader2 as $item){
            $item['url'] = $this->createUrl('/hopam/view',array('id'=>$item['id'],'title'=>Lnt::safeTitle($item['title'])));
            $appItems[] = $item;
        }


        $sql = "SELECT v.id,v.title,v.image,v.term_id,v.view,u.user_id,u.username FROM {{news}} v INNER JOIN xf_user u ON v.user_id = u.user_id WHERE v.status = 1 ORDER BY v.id DESC LIMIT 0,6";
        $cmd = $db->createCommand($sql);
        $dataReader = $cmd->query();
        $newsItems = array();
        foreach($dataReader as $item){
            $item['url'] = $this->createUrl('/news/detail',array('id'=>$item['id'],'title'=>Lnt::safeTitle($item['title']),'tid'=>$item['term_id']));
            $newsItems[] = $item;
        }

        

        $this->render('index',array(
            'appItems' => $appItems,'newsItems'=>$newsItems));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $headers = "From: {$model->email}\r\nReply-To: {$model->email}";
                mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Cảm ơn bạn. Chúng tôi sẽ phản hồi cho bạn trong thời gian sớm nhất!');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->baseUrl . '/css/login.css', 'screen');
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        /*$url = Yii::app()->baseUrl.'/forum/member.php?action=logout&logoutkey='.$MyBBI->mybb->user['logoutkey'];
        $this->redirect($url);*/
        $this->redirect(Yii::app()->homeUrl);
    }


}