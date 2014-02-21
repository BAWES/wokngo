<?php
/* @var $this CharityController */
/* @var $model Charity */

$this->breadcrumbs=array(
	'Charities'=>array('index'),
	$model->charity_id,
);

$this->menu=array(
	array('label'=>'List Charity', 'url'=>array('index')),
	array('label'=>'Create Charity', 'url'=>array('create')),
	array('label'=>'Update Charity', 'url'=>array('update', 'id'=>$model->charity_id)),
	array('label'=>'Delete Charity', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->charity_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Charity', 'url'=>array('admin')),
);
?>

<h1>View Charity #<?php echo $model->charity_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'charity_id',
		'charity_name',
	),
)); ?>
