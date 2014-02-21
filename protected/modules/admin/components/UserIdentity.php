<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;

    public function authenticate() {
        $adminUser = "admin";
        $adminPass = "12345";

        if ($adminUser != $adminUser || $adminPass != $this->password)
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->_id = $adminRecord->admin_id;
            $this->setState('name', $adminRecord->admin_name);
            //user type
            $this->setState('ut', 'admin');
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }

}