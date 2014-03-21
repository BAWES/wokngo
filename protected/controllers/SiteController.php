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

        //New Boxes
        $newBoxes = Item::model()->latest()->findAll();

        //Trending Boxes
        $trendingBoxes = Item::trendingItems(1, 10);

        //Top 10 Boxes
        $top10Boxes = Item::rankedItems();

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
                //render confirmation of subscription page
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
        $this->layout = "main";
        $this->render('about');
    }

    /**
     * Franchise Page
     */
    public function actionFranchise() {
        $this->layout = "main";
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