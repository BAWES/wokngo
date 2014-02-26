<?php
/* @var $this IngredientController */
/* @var $model Ingredient */

$this->breadcrumbs=array(
	'Ingredients'=>array('index'),
	$model->ingredient_id,
);

$this->menu=array(
	array('label'=>'Manage Ingredients', 'url'=>array('index')),
	array('label'=>'Create Ingredient', 'url'=>array('create')),
	array('label'=>'Update Ingredient', 'url'=>array('update', 'id'=>$model->ingredient_id)),
	array('label'=>'Delete Ingredient', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ingredient_id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Ingredient #<?php echo $model->ingredient_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ingredient_id',
		'ingredient_name',
		'ingredient_match_name',
		'ingredient_image',
	),
)); ?>
