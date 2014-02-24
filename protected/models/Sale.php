<?php

/**
 * This is the model class for table "sale".
 *
 * The followings are the available columns in table 'sale':
 * @property integer $sale_id
 * @property integer $item_id
 * @property integer $sale_quantity
 * @property string $sale_datetime
 *
 * The followings are the available model relations:
 * @property Item $item
 */
class Sale extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sale';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('sale_id, item_id, sale_quantity, sale_datetime', 'required'),
            array('sale_id, item_id, sale_quantity', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('sale_id, item_id, sale_quantity, sale_datetime', 'safe', 'on' => 'search'),
        );
    }
    
    //Named Scope for Latest Sales
    public function latest($limit = 1) {
        $this->getDbCriteria()->mergeWith(array(
            'order' => 'sale_id DESC',
            'limit' => $limit,
        ));
        return $this;
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'item' => array(self::BELONGS_TO, 'Item', 'item_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'sale_id' => 'Sale',
            'item_id' => 'Item',
            'sale_quantity' => 'Sale Quantity',
            'sale_datetime' => 'Sale Datetime',
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

        $criteria->compare('sale_id', $this->sale_id);
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('sale_quantity', $this->sale_quantity);
        $criteria->compare('sale_datetime', $this->sale_datetime, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Sale the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
