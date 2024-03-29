<?php

class IngredientController extends Controller {

    public $layout = 'column2';

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Ingredient('create');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);


        if (isset($_POST['Ingredient'])) {
            $model->attributes = $_POST['Ingredient'];
            $pic = CUploadedFile::getInstance($model, 'ingredient_image');

            if ($model->validate()) {
                if ($pic !== null) {
                    $image = WideImage::load($pic->getTempName());
                    $resized = $image->resize(226, 226, 'fill');

                    $fileName = time() . rand(0, 200) . "." . $pic->getExtensionName();
                    $model->ingredient_image = $fileName;
                }

                if ($model->save(false)) {
                    if ($pic !== null) {
                        $filePath = Yii::app()->basePath . '/../images/ingredients/' . $fileName;
                        $resized->saveToFile($filePath);
                    }
                    $this->redirect(array('view', 'id' => $model->ingredient_id));
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);


        if (isset($_POST['Ingredient'])) {
            $oldPic = $model->ingredient_image;
            $pic = CUploadedFile::getInstance($model, 'ingredient_image');
            $model->attributes = $_POST['Ingredient'];

            if ($pic === null)
                $model->ingredient_image = $oldPic;

            if ($model->validate()) {
                if ($pic !== null) {
                    //delete old image
                    if (!empty($oldPic)) {
                        $oldPic = Yii::app()->basePath . "/../images/ingredients/" . $oldPic;

                        if (file_exists($oldPic))
                            unlink($oldPic);
                    }
                    //save new image
                    $image = WideImage::load($pic->getTempName());
                    $resized = $image->resize(226, 226, 'fill');

                    $fileName = time() . rand(0, 200) . "." . $pic->getExtensionName();
                    $model->ingredient_image = $fileName;
                }


                if ($model->save(false)) {
                    if ($pic !== null) {
                        $filePath = Yii::app()->basePath . '/../images/ingredients/' . $fileName;
                        $resized->saveToFile($filePath);
                    }
                    $this->redirect(array('view', 'id' => $model->ingredient_id));
                }
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new Ingredient('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Ingredient']))
            $model->attributes = $_GET['Ingredient'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Ingredient the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Ingredient::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Ingredient $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ingredient-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
