<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->breadcrumbs=array(
	'Customers'=>array('index'),
	$model->customer_id=>array('view','id'=>$model->customer_id),
	'Update',
);

$this->menu=array(
	array('label'=>'Manage Customers', 'url'=>array('index')),
	array('label'=>'View Customer', 'url'=>array('view', 'id'=>$model->customer_id)),
);
?>

<h1>Update Customer <?php echo $model->customer_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>