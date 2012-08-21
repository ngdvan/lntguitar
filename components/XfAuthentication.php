<?php
/**
 * User: thanhdx
 * Date: 6/4/12
 * Time: 1:07 AM
 * @file Authentication.php
 */
//Yii::import('webroot.forum.library.*');
//require_once('XenForo/Autoloader.php');
/*require_once 'Zend/Registry.php';
require_once 'XenForo/Application.php';
require_once 'XenForo/Error.php';
require_once 'XenForo/Visitor.php';
require_once 'XenForo/Model.php';*/
class XfAuthentication {

    public $error = Null;
    public $session;
    public $visitor;
    public function __construct() {
        $startTime = microtime(true);
        $xf_path = Yii::getPathOfAlias('webroot') . '/forum';
        Yii::registerAutoloader(array('XenforeLoader', 'autoload'),true);
        XenForo_Autoloader::getInstance()->setupAutoloader($xf_path . '/library');
        XenForo_Application::initialize($xf_path . '/library', $xf_path);
        XenForo_Application::set('page_start_time', $startTime);

        XenForo_Application::disablePhpErrorHandler();
        error_reporting( E_ALL ^ E_NOTICE ^ E_USER_NOTICE ^ E_WARNING);
        
        $dependencies = new XenForo_Dependencies_Public();
        $dependencies->preLoadData();

        XenForo_Session::startPublicSession();
        $this->visitor = XenForo_Visitor::getInstance();
        /*$fc = new XenForo_FrontController(new XenForo_Dependencies_Public());
        ob_start();
        $fc->run();
        $content = ob_get_clean();*/
    }

    public function checkAuth($username, $password) {
        /**
         * @var $userModel XenForo_Model_User
         */
        $userModel = XenForo_Model::create('XenForo_Model_User');
        $userId = $userModel->validateAuthentication($username, $password, $this->error);
        
        return $userId;
    }

    public function login($username, $password) {
        /**
         * @var $loginModel XenForo_Model_Login
         * @var $userModel XenForo_Model_User
         * @var $session XenForo_Session
         */
        $loginModel = XenForo_Model::create('XenForo_Model_Login');
        $userModel = XenForo_Model::create('XenForo_Model_User');

        $userId = $userModel->validateAuthentication($username, $password, $this->error);
        //var_dump($userId);
        //die;

        if (!$userId) {
            $loginModel->logLoginAttempt($username);

            return false;
        }

        $loginModel->clearLoginAttempts($username);

        /* if ($data['remember'])
          {
          $userModel->setUserRememberCookie($userId);
          } */

        XenForo_Model_Ip::log($userId, 'user', $userId, 'login');

        $userModel->deleteSessionActivity(0, $this->getClientIp(false));

        $session = XenForo_Application::get('session');
        //die('aaabb');

        /*if(!$this->session){
            $this->session = XenForo_Application::get('session');
        }*/
        $session->changeUserId($userId);
        XenForo_Visitor::setup($userId);
        $this->visitor = XenForo_Visitor::getInstance();
        $userInfo = $userModel->getFullUserById($this->visitor->getUserId());

        return $userInfo;
    }

    public function getUser(){
        $visitor = XenForo_Visitor::getInstance();
        $userModel = XenForo_Model::create('XenForo_Model_User');
        $userInfo = $userModel->getFullUserById($visitor->getUserId());

        return $userInfo;
    }
    public function getServer($key = null, $default = null) {
        if (null === $key) {
            return $_SERVER;
        }

        return (isset($_SERVER[$key])) ? $_SERVER[$key] : $default;
    }

    /**
     * Get the client's IP addres
     *
     * @param  boolean $checkProxy
     * @return string
     */
    public function getClientIp($checkProxy = true) {
        if ($checkProxy && $this->getServer('HTTP_CLIENT_IP') != null) {
            $ip = $this->getServer('HTTP_CLIENT_IP');
        } else if ($checkProxy && $this->getServer('HTTP_X_FORWARDED_FOR') != null) {
            $ip = $this->getServer('HTTP_X_FORWARDED_FOR');
        } else {
            $ip = $this->getServer('REMOTE_ADDR');
        }

        return $ip;
    }

}
