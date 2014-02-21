<?php
/* @var $this ItemController */
/* @var $model Item */

$this->breadcrumbs=array(
	'Boxes'=>array('index'),
	$model->item_id,
);

$this->menu=array(
	array('label'=>'Manage Boxes', 'url'=>array('index')),
	array('label'=>'Update Box', 'url'=>array('update', 'id'=>$model->item_id)),
	array('label'=>'Delete Box', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->item_id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Box #<?php echo $model->item_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'item_id',
		'customer_id',
		'item_name',
		'item_ingredients',
		'item_image',
		'item_description',
	),
)); ?>
