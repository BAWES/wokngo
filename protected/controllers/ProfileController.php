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
    
    //change box description page
    public function actionChangeDescription($id) {
        $model = new DescriptionForm;
        
        $id = (int) $id;
        $box = Item::model()->findByPk($id);
        
        if($model===null) throw new CHttpException(404,'The requested box does not exist.');
        
        //Check if box belongs to user
        if($box->customer_id != Yii::app()->user->id) throw new CHttpException(403,'You do not own this box.');

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'description-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['DescriptionForm'])) {
            $model->attributes = $_POST['DescriptionForm'];
            
            if ($model->validate()){
                //change BOX DESCRIPTION here
                $approval = new Approval();
                $approval->item_id = $id;
                $approval->approval_type = 'desc';
                $approval->approval_text = $model->description;
                $approval->save();
                
                $title = "Description Change Requested";
                $content = "Your box description will be changed as soon as it is approved by our staff.";
                $this->render('page',array('title'=>$title,'content'=>$content));
            }
        }
        
        $this->render('changeDescription',array('model'=>$model, 'box'=>$box));
    }
    
    //change box logo page
    public function actionChangeLogo($id) {
        $model = new LogoForm;
        
        $id = (int) $id;
        $box = Item::model()->findByPk($id);
        
        if($model===null) throw new CHttpException(404,'The requested box does not exist.');
        
        //Check if box belongs to user
        if($box->customer_id != Yii::app()->user->id) throw new CHttpException(403,'You do not own this box.');

        // collect user input data
        if (isset($_POST['LogoForm'])) {
            $model->attributes = $_POST['LogoForm'];
            $pic = CUploadedFile::getInstance($model,'logo');
            
            
            if ($model->validate()){
                if($pic!==null){
                    $image = WideImage::load($pic->getTempName());
                    $resized = $image->resize(112, 112,'fill');
				
                    $fileName = time().rand(0,200).".".$pic->getExtensionName();
                    $model->logo=$fileName;
                    
                    $filePath = Yii::app()->basePath.'/../images/box/'.$fileName;
                    $resized->saveToFile($filePath);
		}
                
                $approval = new Approval();
                $approval->item_id = $id;
                $approval->approval_type = 'image';
                $approval->approval_text = $model->logo;
                $approval->save();
                
                $title = "Logo Change Requested";
                $content = "Your box logo will be changed as soon as it is approved by our staff.";
                $this->render('page',array('title'=>$title,'content'=>$content));
            }
        }
        
        $this->render('changeLogo',array('model'=>$model, 'box'=>$box));
    }
    
}