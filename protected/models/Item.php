<?php

/**
 * This is the model class for table "item".
 *
 * The followings are the available columns in table 'item':
 * @property integer $item_id
 * @property integer $customer_id
 * @property string $item_name
 * @property string $item_ingredients
 * @property string $item_image
 * @property string $item_description
 *
 * The followings are the available model relations:
 * @property Approval[] $approvals
 * @property Customer $customer
 * @property Sale[] $sales
 */
class Item extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'item';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('item_id, customer_id, item_name, item_ingredients', 'required'),
            array('item_id, customer_id', 'numerical', 'integerOnly' => true),
            array('item_name', 'length', 'max' => 120),
            array('item_image', 'length', 'max' => 80),
            array('item_description', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('item_id, customer_id, item_name, item_ingredients, item_image, item_description', 'safe', 'on' => 'search'),
        );
    }
    
    
    //Named Scope for Latest Items
    public function latest($limit = 10) {
        $this->getDbCriteria()->mergeWith(array(
            'order' => 'item_id DESC',
            'limit' => $limit,
        ));
        return $this;
    }

    //return path of item image
    public function getImage() {
        if ($this->item_image == null){
            return Yii::app()->request->baseUrl . "/images/box/default.jpg";
        }else{
            return Yii::app()->request->baseUrl . "/images/box/" . $this->item_image;
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'approvals' => array(self::HAS_MANY, 'Approval', 'item_id'),
            'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
            'sales' => array(self::HAS_MANY, 'Sale', 'item_id'),
            'totalSold' => array(self::STAT, 'Sale', 'item_id', 'select' => 'SUM(sale_quantity)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'item_id' => 'Item',
            'customer_id' => 'Customer',
            'item_name' => 'Item Name',
            'item_ingredients' => 'Item Ingredients',
            'item_image' => 'Item Image',
            'item_description' => 'Item Description',
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

        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('customer_id', $this->customer_id);
        $criteria->compare('item_name', $this->item_name, true);
        $criteria->compare('item_ingredients', $this->item_ingredients, true);
        $criteria->compare('item_image', $this->item_image, true);
        $criteria->compare('item_description', $this->item_description, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Item the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
