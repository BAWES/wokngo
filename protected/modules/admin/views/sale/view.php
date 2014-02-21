<?php
/* @var $this SaleController */
/* @var $model Sale */

$this->breadcrumbs=array(
	'Sales'=>array('index'),
	$model->sale_id,
);

$this->menu=array(
	array('label'=>'List Sale', 'url'=>array('index')),
	array('label'=>'Create Sale', 'url'=>array('create')),
	array('label'=>'Update Sale', 'url'=>array('update', 'id'=>$model->sale_id)),
	array('label'=>'Delete Sale', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->sale_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Sale', 'url'=>array('admin')),
);
?>

<h1>View Sale #<?php echo $model->sale_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'sale_id',
		'item_id',
		'sale_quantity',
		'sale_datetime',
	),
)); ?>
