<?php
/* @var $this IngredientController */
/* @var $model Ingredient */

$this->breadcrumbs=array(
	'Ingredients'=>array('index'),
	$model->ingredient_id=>array('view','id'=>$model->ingredient_id),
	'Update',
);

$this->menu=array(
	array('label'=>'Manage Ingredients', 'url'=>array('index')),
	array('label'=>'Create Ingredient', 'url'=>array('create')),
	array('label'=>'View Ingredient', 'url'=>array('view', 'id'=>$model->ingredient_id)),
);
?>

<h1>Update Ingredient <?php echo $model->ingredient_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>