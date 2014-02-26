<?php
/* @var $this IngredientController */
/* @var $model Ingredient */

$this->breadcrumbs=array(
	'Ingredients'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Ingredient', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ingredient-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Ingredients</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ingredient-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ingredient_id',
		'ingredient_name',
		'ingredient_match_name',
		'ingredient_image',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
