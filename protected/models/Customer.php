<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property integer $customer_id
 * @property string $customer_name
 * @property string $customer_phone
 * @property string $customer_email
 * @property string $customer_civil_id
 * @property string $customer_password
 *
 * The followings are the available model relations:
 * @property Item[] $items
 */
class Customer extends CActiveRecord {

    private $salt = "28b206548469ce62182048fd9cf91760";

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'customer';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('customer_id, customer_name, customer_phone, customer_email, customer_civil_id, customer_password', 'required'),
            array('customer_id, customer_civil_id', 'numerical', 'integerOnly' => true),
            array('customer_name, customer_phone, customer_email, customer_password', 'length', 'max' => 120),
            array('customer_email', 'email'),
            array('customer_civil_id', 'length', 'max'=>42),
            array('customer_password', 'rehashPassword', 'on' => 'changePw'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('customer_id, customer_name, customer_phone, customer_email, customer_civil_id, customer_password', 'safe', 'on' => 'search'),
        );
    }

    public function rehashPassword($attribute, $params) {
        $this->customer_password = $this->hashPassword($this->customer_password, $this->salt);
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord)
                $this->customer_password = $this->hashPassword($this->customer_password, $this->salt);

            return true;
        }
        else
            return false;
    }

    //checks password param if equals to current users password
    public function validatePassword($password) {
        return $this->hashPassword($password, $this->salt) === $this->customer_password;
    }

    //hashes password input using given salt
    public function hashPassword($password, $salt) {
        return md5($salt . $password);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'items' => array(self::HAS_MANY, 'Item', 'customer_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'customer_id' => 'Customer',
            'customer_name' => 'Name',
            'customer_phone' => 'Phone',
            'customer_email' => 'Email',
            'customer_civil_id' => 'Civil ID',
            'customer_password' => 'Password',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('customer_id', $this->customer_id);
        $criteria->compare('customer_name', $this->customer_name, true);
        $criteria->compare('customer_phone', $this->customer_phone, true);
        $criteria->compare('customer_email', $this->customer_email, true);
        $criteria->compare('customer_civil_id', $this->customer_civil_id, true);
        $criteria->compare('customer_password', $this->customer_password, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Customer the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
