<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
        private $_id;
        
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
		$userRecord = Customer::model()->findByAttributes(array('customer_email'=>$this->username));
		
		if($userRecord===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID; 
		else if(!$userRecord->validatePassword($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID; 
		else
		{
			$this->_id=$userRecord->customer_id; 
			$this->setState('name', $userRecord->customer_name); 
			//user type
			$this->setState('ut','user');
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
        
        public function getId() 
	{
		return $this->_id; 
	}
}