<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    const ERROR_STATE_FORBIDDEN = 1000;
    
    private $_id;
    private $_name;
    private $_email;

	public function authenticate()
	{
	    $email = strtolower($this->username);
	    $user = User::model()->find('email = ?', array($email));

		if ($user === null)
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		elseif ($user->password != md5($this->password))
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		elseif ($user->state == USER_STATE_FORBIDDEN)
		    $this->errorCode = self::ERROR_STATE_FORBIDDEN;
		else {
			$this->errorCode = self::ERROR_NONE;
			$this->_id = $user->id;
			$this->_name = $user->name;
			$this->_email = $user->email;
			$this->cacheUserData($user);
		}
		return !$this->errorCode;
	}
	
	public function getId()
	{
	    return $this->_id;
	}
	
	public function getEmail()
	{
	    return $this->_email;
	}
	
	public function getName()
	{
	    return $this->_name;
	}
}


