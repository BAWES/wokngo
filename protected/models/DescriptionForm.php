<?php

/**
 * DescriptionForm class.
 */
class DescriptionForm extends CFormModel
{
	public $description;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('description', 'required'),
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
			'description'=>'New Box Description',
		);
	}
}