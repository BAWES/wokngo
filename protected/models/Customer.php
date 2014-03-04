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
            array('customer_id, customer_name, customer_phone, customer_email, customer_civil_id', 'required'),
            array('customer_id, customer_civil_id', 'numerical', 'integerOnly' => true),
            array('customer_name, customer_phone, customer_email, customer_password', 'length', 'max' => 120),
            array('customer_email', 'email'),
            array('customer_email', 'unique'),
            array('customer_civil_id', 'length', 'max' => 42),
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
            if ($this->isNewRecord) {
                //Generate password
                $uniquePassword = rand(10000, 99999);
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

                $mail->AddAddress($this->customer_email); 
                
                $mail->IsHTML(true);
                $mail->Subject = "[Wok&Go] Account Details";
                $mail->Body = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta name='viewport' content='width=device-width'/><meta http-equiv='Content-Type' content='text/html;charset=UTF-8'/><title>Wok&amp;Go</title><style type='text/css'>/* ------------------------------------- GLOBAL ------------------------------------- */*{margin:0;padding:0;}*{font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;}img{max-width: 100%;}.collapse{margin:0;padding:0;}body{-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;width: 100%!important;height: 100%;}/* ------------------------------------- ELEMENTS ------------------------------------- */a{color: #2BA6CB;}.btn{text-decoration:none;color: #FFF;background-color: #666;padding:10px 16px;font-weight:bold;margin-right:10px;text-align:center;cursor:pointer;display: inline-block;}p.callout{padding:15px;background-color:#ECF8FF;margin-bottom: 15px;}.callout a{font-weight:bold;color: #2BA6CB;}table.social{/* padding:15px;*/background-color: #ebebeb;}.social .soc-btn{padding: 3px 7px;font-size:12px;margin-bottom:10px;text-decoration:none;color: #FFF;font-weight:bold;display:block;text-align:center;}a.fb{background-color: #3B5998!important;}a.tw{background-color: #1daced!important;}a.gp{background-color: #DB4A39!important;}a.ms{background-color: #000!important;}.sidebar .soc-btn{display:block;width:100%;}/* ------------------------------------- HEADER ------------------------------------- */table.head-wrap{width: 100%;}.header.container table td.logo{padding: 15px;}.header.container table td.label{padding: 15px;padding-left:0px;}/* ------------------------------------- BODY ------------------------------------- */table.body-wrap{width: 100%;}/* ------------------------------------- FOOTER ------------------------------------- */table.footer-wrap{width: 100%;clear:both!important;}.footer-wrap .container td.content p{border-top: 1px solid rgb(215,215,215);padding-top:15px;}.footer-wrap .container td.content p{font-size:10px;font-weight: bold;}/* ------------------------------------- TYPOGRAPHY ------------------------------------- */h1,h2,h3,h4,h5,h6{font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;line-height: 1.1;margin-bottom:15px;color:#000;}h1 small, h2 small, h3 small, h4 small, h5 small, h6 small{font-size: 60%;color: #6f6f6f;line-height: 0;text-transform: none;}h1{font-weight:200;font-size: 44px;}h2{font-weight:200;font-size: 37px;}h3{font-weight:500;font-size: 27px;}h4{font-weight:500;font-size: 23px;}h5{font-weight:900;font-size: 17px;}h6{font-weight:900;font-size: 14px;text-transform: uppercase;color:#444;}.collapse{margin:0!important;}p, ul{margin-bottom: 10px;font-weight: normal;font-size:14px;line-height:1.6;}p.lead{font-size:17px;}p.last{margin-bottom:0px;}ul li{margin-left:5px;list-style-position: inside;}/* ------------------------------------- SIDEBAR ------------------------------------- */ul.sidebar{background:#ebebeb;display:block;list-style-type: none;}ul.sidebar li{display: block;margin:0;}ul.sidebar li a{text-decoration:none;color: #666;padding:10px 16px;/* font-weight:bold;*/margin-right:10px;/* text-align:center;*/cursor:pointer;border-bottom: 1px solid #777777;border-top: 1px solid #FFFFFF;display:block;margin:0;}ul.sidebar li a.last{border-bottom-width:0px;}ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p{margin-bottom:0!important;}/* --------------------------------------------------- RESPONSIVENESSNuke it from orbit. It's the only way to be sure. ------------------------------------------------------ *//* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */.container{display:block!important;max-width:600px!important;margin:0 auto!important;/* makes it centered */clear:both!important;}/* This should also be a block element, so that it will fill 100% of the .container */.content{padding:15px;max-width:600px;margin:0 auto;display:block;}/* Let's make sure tables in the content area are 100% wide */.content table{width: 100%;}/* Odds and ends */.column{width: 300px;float:left;}.column tr td{padding: 15px;}.column-wrap{padding:0!important;margin:0 auto;max-width:600px!important;}.column table{width:100%;}.social .column{width: 280px;min-width: 279px;float:left;}/* Be sure to place a .clear element after each set of columns, just to be safe */.clear{display: block;clear: both;}/* ------------------------------------------- PHONEFor clients that support media queries.Nothing fancy. -------------------------------------------- */@media only screen and (max-width: 600px){a[class='btn']{display:block!important;margin-bottom:10px!important;background-image:none!important;margin-right:0!important;}div[class='column']{width: auto!important;float:none!important;}table.social div[class='column']{width:auto!important;}}</style></head><body bgcolor='#FFFFFF'><table class='head-wrap' bgcolor='#191919'><tr><td></td><td class='header container' ><div class='content'><table><tr><td><img src='http://wokandgo.me/images/woklogo200x50.jpg'/></td><td align='right'><h6 class='collapse'></h6></td></tr></table></div></td><td></td></tr></table><table class='body-wrap'><tr><td></td><td class='container' bgcolor='#FFFFFF'><div class='content'><table><tr><td><h3>Hi, ".$this->customer_name."</h3><p class='lead'>Welcome to the Wok&amp;Go Community!</p><p>By logging into our website you will be able to keep track of your boxes, their sales, and how you rank against your competitors! Stay tuned to find out who our lucky winner is!</p><p class='callout'><strong>Your Access Details</strong><br/>Email: ".$this->customer_email."<br/>Password: $uniquePassword</p><table class='social' width='100%'><tr><td><table align='left' class='column'><tr><td><h5 class=''>Connect with Us:</h5><p class=''><a href='#' class='soc-btn fb'>Facebook</a><a href='#' class='soc-btn tw'>Twitter</a><a href='#' class='soc-btn gp'>Instagram</a></p></td></tr></table><table align='left' class='column'><tr><td><h5 class=''>Contact Info:</h5><p>Phone: <strong>+965 2220 2225</strong><br/> Email: <strong><a href='emailto:customerservice@wokandgo.me'>customerservice@wokandgo.me</a></strong></p></td></tr></table><span class='clear'></span></td></tr></table></td></tr></table></div></td><td></td></tr></table></body></html>";
           

                if (!$mail->Send()) {
                    //echo $mail->ErrorInfo;
                } else {
                    //mail has been sent
                }

                $this->customer_password = $this->hashPassword($uniquePassword, $this->salt);
            }

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
            'sales' => array(self::HAS_MANY, 'Sale', 'item_id', 'through' => 'items', 'order' => 'sale_datetime ASC'),
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
