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
    
}