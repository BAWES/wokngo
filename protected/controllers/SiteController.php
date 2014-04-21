<?php

class SiteController extends Controller {

    public $layout = "page";

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionTestIntegration() {
        /* SOAP TEST */
        /*
          $client = new SoapClient('http://localhost/wokngo/index.php/service/soap');
          echo $client->updateCustomer(1,"Khalid Al-Mutawa","99811042","khalid@khalidm.net","289100500862");
         */
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {

        $this->layout = "main";

        $numBoxes = Item::model()->findAll();
        if (count($numBoxes)) {
            //New Boxes
            $newBoxes = Item::model()->latest()->findAll();

            //Trending Boxes
            if (count($numBoxes) > 10) {
                $trendingBoxes = Item::trendingItems(1, 10);
            }
            else
                $trendingBoxes = "";

            //Top 10 Boxes
            $top10Boxes = Item::rankedItems();
        }
        else {
            $newBoxes = "";
            $trendingBoxes = "";
            $top10Boxes = "";
        }
        $this->render('index', array(
            'newBoxes' => $newBoxes,
            'trendingBoxes' => $trendingBoxes,
            'top10Boxes' => $top10Boxes,
        ));
    }

    /**
     * Email subscription
     */
    public function actionSubscribe() {
        $model = new Subscribe();

        $this->performAjaxValidation($model);

        if (isset($_POST['Subscribe'])) {
            $model->attributes = $_POST['Subscribe'];
            if ($model->save()) {
                Yii::app()->user->setFlash('subscribe', 'Thank you for signing up for our newsletter.');
                $this->refresh();
            }
        }

        $this->render('subscribe', array(
            'model' => $model
        ));
    }

    /**
     * Performs the AJAX validation.
     * @param Customer $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'subscribe-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * About Page
     */
    public function actionAbout() {
        //$this->layout = "main";
        $this->render('about');
    }
    
    /**
     * Location Page
     */
    public function actionLocations() {
        //$this->layout = "main";
        $this->render('locations');
    }

    /**
     * Franchise Page
     */
    public function actionFranchise() {
        //$this->layout = "main";
        $this->render('franchise');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['firas'], $subject, $model->body, $headers);
                mail(Yii::app()->params['hassan'], $subject, $model->body, $headers);
                mail(Yii::app()->params['sami'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Forgot password page
     */
    public function actionForgotPassword() {
        $model = new ForgotPasswordForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'forgot-password-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['ForgotPasswordForm'])) {
            $model->attributes = $_POST['ForgotPasswordForm'];
            if ($model->validate()) {
                //Send email with link to change password
                //echo $model->email;

                $customer = Customer::model()->findByAttributes(array('customer_email' => $model->email));

                $resetLink = Yii::app()->createAbsoluteUrl('site/resetPassword', array('id' => $customer->customer_id, 
                                                                                        'h' => $customer->customer_password));

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

                $mail->AddAddress($customer->customer_email);

                $mail->IsHTML(true);
                $mail->Subject = "[Wok&Go] Password Reset";
                $mail->Body = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta name='viewport' content='width=device-width'/><meta http-equiv='Content-Type' content='text/html;charset=UTF-8'/><title>Wok&amp;Go</title><style type='text/css'>/* ------------------------------------- GLOBAL ------------------------------------- */*{margin:0;padding:0;}*{font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;}img{max-width: 100%;}.collapse{margin:0;padding:0;}body{-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;width: 100%!important;height: 100%;}/* ------------------------------------- ELEMENTS ------------------------------------- */a{color: #2BA6CB;}.btn{text-decoration:none;color: #FFF;background-color: #666;padding:10px 16px;font-weight:bold;margin-right:10px;text-align:center;cursor:pointer;display: inline-block;}p.callout{padding:15px;background-color:#ECF8FF;margin-bottom: 15px;}.callout a{font-weight:bold;color: #2BA6CB;}table.social{/* padding:15px;*/background-color: #ebebeb;}.social .soc-btn{padding: 3px 7px;font-size:12px;margin-bottom:10px;text-decoration:none;color: #FFF;font-weight:bold;display:block;text-align:center;}a.fb{background-color: #3B5998!important;}a.tw{background-color: #1daced!important;}a.gp{background-color: #DB4A39!important;}a.ms{background-color: #000!important;}.sidebar .soc-btn{display:block;width:100%;}/* ------------------------------------- HEADER ------------------------------------- */table.head-wrap{width: 100%;}.header.container table td.logo{padding: 15px;}.header.container table td.label{padding: 15px;padding-left:0px;}/* ------------------------------------- BODY ------------------------------------- */table.body-wrap{width: 100%;}/* ------------------------------------- FOOTER ------------------------------------- */table.footer-wrap{width: 100%;clear:both!important;}.footer-wrap .container td.content p{border-top: 1px solid rgb(215,215,215);padding-top:15px;}.footer-wrap .container td.content p{font-size:10px;font-weight: bold;}/* ------------------------------------- TYPOGRAPHY ------------------------------------- */h1,h2,h3,h4,h5,h6{font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;line-height: 1.1;margin-bottom:15px;color:#000;}h1 small, h2 small, h3 small, h4 small, h5 small, h6 small{font-size: 60%;color: #6f6f6f;line-height: 0;text-transform: none;}h1{font-weight:200;font-size: 44px;}h2{font-weight:200;font-size: 37px;}h3{font-weight:500;font-size: 27px;}h4{font-weight:500;font-size: 23px;}h5{font-weight:900;font-size: 17px;}h6{font-weight:900;font-size: 14px;text-transform: uppercase;color:#444;}.collapse{margin:0!important;}p, ul{margin-bottom: 10px;font-weight: normal;font-size:14px;line-height:1.6;}p.lead{font-size:17px;}p.last{margin-bottom:0px;}ul li{margin-left:5px;list-style-position: inside;}/* ------------------------------------- SIDEBAR ------------------------------------- */ul.sidebar{background:#ebebeb;display:block;list-style-type: none;}ul.sidebar li{display: block;margin:0;}ul.sidebar li a{text-decoration:none;color: #666;padding:10px 16px;/* font-weight:bold;*/margin-right:10px;/* text-align:center;*/cursor:pointer;border-bottom: 1px solid #777777;border-top: 1px solid #FFFFFF;display:block;margin:0;}ul.sidebar li a.last{border-bottom-width:0px;}ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p{margin-bottom:0!important;}/* --------------------------------------------------- RESPONSIVENESSNuke it from orbit. It's the only way to be sure. ------------------------------------------------------ *//* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */.container{display:block!important;max-width:600px!important;margin:0 auto!important;/* makes it centered */clear:both!important;}/* This should also be a block element, so that it will fill 100% of the .container */.content{padding:15px;max-width:600px;margin:0 auto;display:block;}/* Let's make sure tables in the content area are 100% wide */.content table{width: 100%;}/* Odds and ends */.column{width: 300px;float:left;}.column tr td{padding: 15px;}.column-wrap{padding:0!important;margin:0 auto;max-width:600px!important;}.column table{width:100%;}.social .column{width: 280px;min-width: 279px;float:left;}/* Be sure to place a .clear element after each set of columns, just to be safe */.clear{display: block;clear: both;}/* ------------------------------------------- PHONEFor clients that support media queries.Nothing fancy. -------------------------------------------- */@media only screen and (max-width: 600px){a[class='btn']{display:block!important;margin-bottom:10px!important;background-image:none!important;margin-right:0!important;}div[class='column']{width: auto!important;float:none!important;}table.social div[class='column']{width:auto!important;}}</style></head><body bgcolor='#FFFFFF'><table class='head-wrap' bgcolor='#191919'><tr><td></td><td class='header container' ><div class='content'><table><tr><td><img src='http://wokandgo.me/images/woklogo200x50.jpg'/></td><td align='right'><h6 class='collapse'></h6></td></tr></table></div></td><td></td></tr></table><table class='body-wrap'><tr><td></td><td class='container' bgcolor='#FFFFFF'><div class='content'><table><tr><td><h3>Hi, " . $customer->customer_name . "</h3><p class='lead'>Please click the following link to reset your password</p><p><a href='$resetLink'>Reset your password</a></p><table class='social' width='100%'><tr><td><table align='left' class='column'><tr><td><h5 class=''>Connect with Us:</h5><p class=''><a href='https://www.facebook.com/wokngokw' class='soc-btn fb'>Facebook</a><a href='https://twitter.com/wokngo_kw' class='soc-btn tw'>Twitter</a><a href='http://instagram.com/wokngo_kw' class='soc-btn gp'>Instagram</a></p></td></tr></table><table align='left' class='column'><tr><td><h5 class=''>Contact Info:</h5><p>Phone: <strong>+965 2220 2225</strong><br/> Email: <strong><a href='emailto:customerservice@wokandgo.me'>customerservice@wokandgo.me</a></strong></p></td></tr></table><span class='clear'></span></td></tr></table></td></tr></table></div></td><td></td></tr></table></body></html>";


                if (!$mail->Send()) {
                    error_log($mail->ErrorInfo);
                } else {
                    //mail has been sent
                }

                $this->render('forgotPasswordThanks');
            }
        }

        $this->render('forgotPassword', array('model' => $model));
    }

    /**
     * Password reset page (copy the one from profile area)
     */
    public function actionResetPassword($id, $h) { //takes customer id and his hashed password
        $id = (int) $id;
        $customer = Customer::model()->findByPk($id);
        if(!$customer) throw new CHttpException(404, "Page not found");
        if($customer->customer_password != $h) throw new CHttpException(404, "Page not found");
        
        $model = new PasswordForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'password-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['PasswordForm'])) {
            $model->attributes = $_POST['PasswordForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate()){
                //change PASSWORD HERE
                $user = $customer;
                $user->scenario = "changePw";
                $user->customer_password = $model->password;
                $user->save();
                
                $this->render('resetPasswordThanks');
            }
        }
        
        $this->render('resetPassword',array('model'=>$model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(array('profile/index'));
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}