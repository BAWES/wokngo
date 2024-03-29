<?php

/**
 * LogoForm class.
 */
class LogoForm extends CFormModel {

    public $logo;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('logo', 'file', 'types' => 'jpg, gif, png, jpeg', 'allowEmpty' => false),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'logo' => 'New Photo',
        );
    }

}