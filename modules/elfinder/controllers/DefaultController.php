<?php

class DefaultController extends Controller
{
    public function actionConnector()
	{
        $this->layout=false;
        
        Yii::import('elfinder.vendors.*');
        require_once('elFinder.class.php');

        $opts=array(
            'root'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR,
            'URL'=>Yii::app()->baseUrl.'/upload/',
            'rootAlias'=>'Home',
        );

        $fm=new elFinder($opts);
        $fm->run();
	}
}