<?php

/**
 * ForgotPasswordForm class.
 */
class ForgotPasswordForm extends CFormModel {

    public $email;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('email', 'required'),
            array('email', 'email'),
            array('email', 'emailExists'),
        );
    }

    /**
     * check if a customer exists with the email submitted
     * This is the 'emailExists' validator as declared in rules().
     */
    public function emailExists($attribute, $params) {
        
        $customer = Customer::model()->findByAttributes(array('customer_email'=>$this->$attribute));        
        if (!$customer)
            $this->addError($attribute, 'Email does not exist');
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'email' => 'Email',
        );
    }

}