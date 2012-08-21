<?php
/**
 * User: thanhdx
 * Date: 6/7/12
 * Time: 12:53 AM
 * @file PageController.php
 */
class PageController extends Controller
{

    public function actionView(){
        $page = Page::model()->findByPk($_GET['id']);
        $this->render('view',array('page'=>$page));
    }
}
