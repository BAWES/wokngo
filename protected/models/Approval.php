<?php

/**
 * This is the model class for table "approval".
 *
 * The followings are the available columns in table 'approval':
 * @property string $approval_id
 * @property integer $item_id
 * @property string $approval_type
 * @property string $approval_text
 *
 * The followings are the available model relations:
 * @property Item $item
 */
class Approval extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'approval';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_id, approval_type, approval_text', 'required'),
			array('item_id', 'numerical', 'integerOnly'=>true),
			array('approval_type', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('approval_id, item_id, approval_type, approval_text', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'item' => array(self::BELONGS_TO, 'Item', 'item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'approval_id' => 'Approval',
			'item_id' => 'Item',
			'approval_type' => 'Approval Type',
			'approval_text' => 'Approval Text',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('approval_id',$this->approval_id,true);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('approval_type',$this->approval_type,true);
		$criteria->compare('approval_text',$this->approval_text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Approval the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
