<?php

class ApprovalController extends Controller
{
	public $layout='column1';


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Approval');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
        
        /**
	 * Approves the change
	 */
	public function actionApprove($id)
	{
		$id = (int) $id;
                $model = $this->loadModel($id);
                $item = $model->item;
                
                if($model->approval_type == "image"){
                    $item->item_image = $model->approval_text;
                }else{
                    $item->item_description = $model->approval_text;
                }
                
                $item->save();
                $model->delete();
                
                
                $this->redirect(array('approval/index'));
	}
        
        /**
	 * Reject the change
	 */
	public function actionReject($id)
	{
		$id = (int) $id;
                $model = $this->loadModel($id)->delete();
                
                $this->redirect(array('approval/index'));
	}

	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Approval the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Approval::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested approval does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Approval $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='approval-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
