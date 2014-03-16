<?php

/**
 * PasswordForm class.
 */
class PasswordForm extends CFormModel
{
	public $password;
	public $verifyPassword;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('password, verifyPassword', 'required'),
                        array('password, verifyPassword', 'length', 'min'=>6, 'max'=>40),
                        array('password', 'compare', 'compareAttribute'=>'verifyPassword'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'password'=>'New Password',
			'verifyPassword'=>'Verify New Password',
		);
	}
}