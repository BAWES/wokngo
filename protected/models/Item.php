<?php

/**
 * This is the model class for table "item".
 *
 * The followings are the available columns in table 'item':
 * @property integer $item_id
 * @property integer $customer_id
 * @property string $item_name
 * @property string $item_seo_name
 * @property string $item_ingredients
 * @property string $item_image
 * @property string $item_description
 * @property string $item_created_at
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
            array('item_id, customer_id, item_name, item_seo_name, item_ingredients, item_image, item_created_at, item_description', 'safe', 'on' => 'search'),
        );
    }

    //Named Scope for Latest Items
    public function latest($limit = 10) {
        $this->getDbCriteria()->mergeWith(array(
            'order' => 'item_created_at DESC',
            'limit' => $limit,
        ));
        return $this;
    }

    //return path of item image
    public function getImage() {
        if ($this->item_image == null) {
            return Yii::app()->request->baseUrl . "/images/box/default.jpg";
        } else {
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
            'item_seo_name' => 'Item SEO',
            'item_ingredients' => 'Item Ingredients',
            'item_image' => 'Item Image',
            'item_description' => 'Item Description',
            'item_created_at' => 'Item Created at',
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
        $criteria->compare('item_seo_name', $this->item_seo_name, true);
        $criteria->compare('item_ingredients', $this->item_ingredients, true);
        $criteria->compare('item_image', $this->item_image, true);
        $criteria->compare('item_description', $this->item_description, true);
        $criteria->compare('item_created_at', $this->item_created_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function beforeSave() {
        $seoName = $this->item_name;

        $seoName = strtolower($seoName);
        //Make alphanumeric (removes all other characters)
        $seoName = preg_replace("/[^a-z0-9_\s-]/", "", $seoName);
        //Clean up multiple dashes or whitespaces
        $seoName = preg_replace("/[\s-]+/", " ", $seoName);
        //Convert whitespaces and underscore to dash
        $seoName = preg_replace("/[\s_]/", "-", $seoName);

        $this->item_seo_name = $seoName;
        $this->item_created_at = new CDbExpression("NOW()");
        
        return parent::beforeSave();
    }

    public static function trendingItems($trendingDays = 1, $numBoxes = 10) {
        $lastSale = Sale::model()->latest()->find();
        $lastSaleDateTime = strtotime($lastSale->sale_datetime);

        $lastSaleDate = date("Y-m-d", $lastSaleDateTime);
        $daysBefore = date('Y-m-d', $lastSaleDateTime - 60 * 60 * 24 * $trendingDays);

        $items = Item::model()->with(array(
                    'sales' => array(
                        'select' => false,
                        'joinType' => 'INNER JOIN',
                        'condition' => "date(sales.sale_datetime)<='$lastSaleDate' && date(sales.sale_datetime)>='$daysBefore'",
                        'order' => 'sales.sale_quantity DESC'
            )))->findAll();

        if (count($items) < $numBoxes)
            return Item::trendingItems($trendingDays + 2, $numBoxes);
        return $items;
    }
    
    //Get the Rank of this box
    public function getRank(){
        $allRanked = Item::rankedItems();
        $rank = 0;
        foreach($allRanked as $box){
            $rank++;
            if($box['item_id'] == $this->item_id) return $rank;
        }
    }

    //Get All Boxes Listed by Rank
    public static function rankedItems() {
        $query = Yii::app()->db->createCommand();
        $query->select('item.item_id, item.item_name, item.item_seo_name, item.item_description, item.item_image,'
                . 'customer.customer_name, sum(sale.sale_quantity) as sales');
        $query->from('item');
        $query->leftJoin('sale', 'item.item_id=sale.item_id');
        $query->leftJoin('customer', 'item.customer_id=customer.customer_id');
        $query->group('item.item_id');
        $query->order('sales DESC');

        return $query->queryAll();

        /* Example Usage:

          $rank=0;
          foreach(Item::rankings() as $box){
          $rank++;
          $boxID = $box['item_id'];
          $boxName = $box['item_name'];
          $boxSEO = $box['item_seo_name'];
          $boxImage = $box['item_image'];
          $boxDesc = $box['item_description'];
          $boxSales = (int) $box['sales'];
          $customer = $box['customer_name'];

          echo "$rank - $boxID - $boxSales - $boxName - $boxImage - $boxDesc - $customer<br/><br/>";
          }
         */
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
