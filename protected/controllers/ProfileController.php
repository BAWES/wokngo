<?php

class ProfileController extends Controller {

    public $layout = "page";
    
    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('deny', // deny all unauth users
                'users' => array('?'),
            ),
        );
    }
    
    //default profile page
    public function actionIndex() {
        $user = Customer::model()->findByPk(Yii::app()->user->id);
        
        $this->render('index',array('user'=>$user));
    }
    
    //change password page
    public function actionChangePassword() {
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
                $user = Customer::model()->findByPk(Yii::app()->user->id);
                $user->scenario = "changePw";
                $user->customer_password = $model->password;
                $user->save();
                
                $title = "Password Changed";
                $content = "Your password has been changed.";
                $this->render('page',array('title'=>$title,'content'=>$content));
            }
        }
        
        $this->render('changePassword',array('model'=>$model));
    }
    
}