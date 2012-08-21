<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;
    private $_fullname;

    public function setId($id)
    {
        $this->_id = $id;
    }

    public function getId()
    {
        return $this->_id;
    }

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        /**
         * @var $user XfUser
         */
        $user = XfUser::model()->find('LOWER(username)=?', array(strtolower($this->username)));
        $xfAuth = new XfAuthentication();

        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if (!$xfAuth->checkAuth($this->username, $this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $userInfo = $xfAuth->login($this->username, $this->password);
            //var_dump($userInfo);die;
            if($userInfo){
                $this->_id = $userInfo['user_id'];
                $this->username = $userInfo['username'];
                Rights::assign($user['role'], $this->_id);
                $this->errorCode = self::ERROR_NONE;
            }else{
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            }
        }
        //unset($xfAuth);
        return !$this->errorCode;
    }
}