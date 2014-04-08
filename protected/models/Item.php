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

    public $customer_search;

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
            array('item_id, customer_search, customer_id, item_name, item_seo_name, item_ingredients, item_image, item_created_at, item_description', 'safe', 'on' => 'search'),
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
            'sales' => array(self::HAS_MANY, 'Sale', 'item_id', 'order' => 'sale_datetime ASC'),
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
            'customer_search' => 'Customer',
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

        $criteria->with = "customer";

        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('customer_id', $this->customer_id);
        $criteria->compare('item_name', $this->item_name, true);
        $criteria->compare('item_seo_name', $this->item_seo_name, true);
        $criteria->compare('item_ingredients', $this->item_ingredients, true);
        $criteria->compare('item_image', $this->item_image, true);
        $criteria->compare('item_description', $this->item_description, true);
        $criteria->compare('item_created_at', $this->item_created_at, true);

        //Add search function to related
        $criteria->compare('customer.customer_name', $this->customer_search, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(//add sorting to related model
                'attributes' => array(
                    'customer_search' => array(
                        'asc' => 'customer.customer_name',
                        'desc' => 'customer.customer_name DESC',
                    ),
                    '*', //* means treat other fields normally
                ),
            ),
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
        

        if ($this->isNewRecord) {
            $this->item_created_at = new CDbExpression("NOW()");
            
            //do not send email if this is the customer's first box
            $customerItems = $this->customer->items;
            if (count($customerItems) > 1) {
                //email/sms this password to customer
                require_once('class.phpmailer.php');

                $mail = new PHPMailer();
                $mail->CharSet = "UTF-8";
                $mail->IsSMTP(); // set mailer to use SMTP
                $mail->Mailer = "smtp";
                $mail->Host = "ssl://wok.wokandgo.me";
                $mail->Port = 465;
                $mail->SMTPAuth = true; // turn on SMTP authentication
                //$mail->SMTPSecure = "tls";
                $mail->Username = 'notification@wokandgo.me'; // SMTP username
                $mail->Password = 'k99811042'; // SMTP password
                $mail->From = 'notification@wokandgo.me'; //do NOT fake header.
                $mail->FromName = 'Wok&Go';

                $mail->AddAddress($this->customer->customer_email);

                $mail->IsHTML(true);
                $mail->Subject = "[Wok&Go] New Box: ".$this->item_name;
                $mail->Body = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta name='viewport' content='width=device-width'/><meta http-equiv='Content-Type' content='text/html;charset=UTF-8'/><title>Wok&amp;Go</title><style type='text/css'>/* ------------------------------------- GLOBAL ------------------------------------- */*{margin:0;padding:0;}*{font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;}img{max-width: 100%;}.collapse{margin:0;padding:0;}body{-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;width: 100%!important;height: 100%;}/* ------------------------------------- ELEMENTS ------------------------------------- */a{color: #2BA6CB;}.btn{text-decoration:none;color: #FFF;background-color: #666;padding:10px 16px;font-weight:bold;margin-right:10px;text-align:center;cursor:pointer;display: inline-block;}p.callout{padding:15px;background-color:#ECF8FF;margin-bottom: 15px;}.callout a{font-weight:bold;color: #2BA6CB;}table.social{/* padding:15px;*/background-color: #ebebeb;}.social .soc-btn{padding: 3px 7px;font-size:12px;margin-bottom:10px;text-decoration:none;color: #FFF;font-weight:bold;display:block;text-align:center;}a.fb{background-color: #3B5998!important;}a.tw{background-color: #1daced!important;}a.gp{background-color: #DB4A39!important;}a.ms{background-color: #000!important;}.sidebar .soc-btn{display:block;width:100%;}/* ------------------------------------- HEADER ------------------------------------- */table.head-wrap{width: 100%;}.header.container table td.logo{padding: 15px;}.header.container table td.label{padding: 15px;padding-left:0px;}/* ------------------------------------- BODY ------------------------------------- */table.body-wrap{width: 100%;}/* ------------------------------------- FOOTER ------------------------------------- */table.footer-wrap{width: 100%;clear:both!important;}.footer-wrap .container td.content p{border-top: 1px solid rgb(215,215,215);padding-top:15px;}.footer-wrap .container td.content p{font-size:10px;font-weight: bold;}/* ------------------------------------- TYPOGRAPHY ------------------------------------- */h1,h2,h3,h4,h5,h6{font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;line-height: 1.1;margin-bottom:15px;color:#000;}h1 small, h2 small, h3 small, h4 small, h5 small, h6 small{font-size: 60%;color: #6f6f6f;line-height: 0;text-transform: none;}h1{font-weight:200;font-size: 44px;}h2{font-weight:200;font-size: 37px;}h3{font-weight:500;font-size: 27px;}h4{font-weight:500;font-size: 23px;}h5{font-weight:900;font-size: 17px;}h6{font-weight:900;font-size: 14px;text-transform: uppercase;color:#444;}.collapse{margin:0!important;}p, ul{margin-bottom: 10px;font-weight: normal;font-size:14px;line-height:1.6;}p.lead{font-size:17px;}p.last{margin-bottom:0px;}ul li{margin-left:5px;list-style-position: inside;}/* ------------------------------------- SIDEBAR ------------------------------------- */ul.sidebar{background:#ebebeb;display:block;list-style-type: none;}ul.sidebar li{display: block;margin:0;}ul.sidebar li a{text-decoration:none;color: #666;padding:10px 16px;/* font-weight:bold;*/margin-right:10px;/* text-align:center;*/cursor:pointer;border-bottom: 1px solid #777777;border-top: 1px solid #FFFFFF;display:block;margin:0;}ul.sidebar li a.last{border-bottom-width:0px;}ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p{margin-bottom:0!important;}/* --------------------------------------------------- RESPONSIVENESSNuke it from orbit. It's the only way to be sure. ------------------------------------------------------ *//* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */.container{display:block!important;max-width:600px!important;margin:0 auto!important;/* makes it centered */clear:both!important;}/* This should also be a block element, so that it will fill 100% of the .container */.content{padding:15px;max-width:600px;margin:0 auto;display:block;}/* Let's make sure tables in the content area are 100% wide */.content table{width: 100%;}/* Odds and ends */.column{width: 300px;float:left;}.column tr td{padding: 15px;}.column-wrap{padding:0!important;margin:0 auto;max-width:600px!important;}.column table{width:100%;}.social .column{width: 280px;min-width: 279px;float:left;}/* Be sure to place a .clear element after each set of columns, just to be safe */.clear{display: block;clear: both;}/* ------------------------------------------- PHONEFor clients that support media queries.Nothing fancy. -------------------------------------------- */@media only screen and (max-width: 600px){a[class='btn']{display:block!important;margin-bottom:10px!important;background-image:none!important;margin-right:0!important;}div[class='column']{width: auto!important;float:none!important;}table.social div[class='column']{width:auto!important;}}</style></head><body bgcolor='#FFFFFF'><table class='head-wrap' bgcolor='#191919'><tr><td></td><td class='header container' ><div class='content'><table><tr><td><img src='http://wokandgo.me/images/woklogo200x50.jpg'/></td><td align='right'><h6 class='collapse'></h6></td></tr></table></div></td><td></td></tr></table><table class='body-wrap'><tr><td></td><td class='container' bgcolor='#FFFFFF'><div class='content'><table><tr><td><h3>Hi, " . $this->customer->customer_name . "</h3><p class='lead'>Thank you for creating another box with Wok&amp;Go!</p><p>By logging into our website you will be able to keep track of your boxes, their sales, and how you rank against your competitors! Stay tuned to find out who our lucky winner is!<br/><br/><a href='".Yii::app()->createAbsoluteUrl('box/view',array('seo'=>$this->item_seo_name))."'>View your box on our website</a></p><table class='social' width='100%'><tr><td><table align='left' class='column'><tr><td><h5 class=''>Connect with Us:</h5><p class=''><a href='https://www.facebook.com/wokngokw' class='soc-btn fb'>Facebook</a><a href='https://twitter.com/wokngo_kw' class='soc-btn tw'>Twitter</a><a href='http://instagram.com/wokngo_kw' class='soc-btn gp'>Instagram</a></p></td></tr></table><table align='left' class='column'><tr><td><h5 class=''>Contact Info:</h5><p>Phone: <strong>+965 2220 2225</strong><br/> Email: <strong><a href='emailto:customerservice@wokandgo.me'>customerservice@wokandgo.me</a></strong></p></td></tr></table><span class='clear'></span></td></tr></table></td></tr></table></div></td><td></td></tr></table></body></html>";


                if (!$mail->Send()) {
                    error_log($mail->ErrorInfo);
                } else {
                    //mail has been sent
                }
            }
        }

        return parent::beforeSave();
    }

    public static function trendingItems($trendingDays = 1, $numBoxes = 10, $recursed = 0) {
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
        if (count($items) < 4) {
            return $items;
        }
        if ($recursed > 2) { //if recursed more than twice - stop recursion
            return $items;
        }
        if (count($items) < $numBoxes)
            $recursed++;
        return Item::trendingItems($trendingDays + 2, $numBoxes, $recursed);
        return $items;
    }

    //Get the Rank of this box
    public function getRank() {
        $allRanked = Item::rankedItems();
        $rank = 0;
        foreach ($allRanked as $box) {
            $rank++;
            if ($box['item_id'] == $this->item_id)
                return $rank;
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
