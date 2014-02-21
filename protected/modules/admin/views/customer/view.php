<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->breadcrumbs=array(
	'Customers'=>array('index'),
	$model->customer_id,
);

$this->menu=array(
	array('label'=>'Manage Customers', 'url'=>array('index')),
	array('label'=>'Update Customer', 'url'=>array('update', 'id'=>$model->customer_id)),
	array('label'=>'Delete Customer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->customer_id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Customer #<?php echo $model->customer_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'customer_id',
		'customer_name',
		'customer_phone',
		'customer_email',
		'customer_password',
		'customer_civil_id',
	),
)); ?>
