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
    public function actionIndex() {
        /* SOAP TEST */
        /*
          $client = new SoapClient('http://localhost/wokngo/index.php/service/soap');
          echo $client->updateCustomer(1,"Khalid Al-Mutawa","99811042","khalid@khalidm.net","289100500862");
         */
        $this->layout = "main";

        //New Wokers
        $newBoxes = Item::model()->latest()->findAll();

        //Trending Wokers
        $trendingBoxes = $this->getTrendingWokers(1,10);
        
        //TOP 10 WOKERS

        $this->render('index', array(
            'newBoxes' => $newBoxes,
            'trendingBoxes' => $trendingBoxes,
            
        ));
    }

    public function getTrendingWokers($trendingDays = 1, $numBoxes = 10) {
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
        
        if(count($items)<$numBoxes) return $this->getTrendingWokers($trendingDays+2,$numBoxes);
        return $items;
    }

    /**
     * About Page
     */
    public function actionAbout() {
        $this->render('about');
    }

    /**
     * Franchise Page
     */
    public function actionFranchise() {
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

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionSignin() {
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
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('signin', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}