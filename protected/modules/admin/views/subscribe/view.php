<?php
/* @var $this SubscribeController */
/* @var $model Subscribe */

$this->breadcrumbs=array(
	'Subscribes'=>array('index'),
	$model->subscribe_id,
);

$this->menu=array(
	array('label'=>'Manage Subscriptions', 'url'=>array('index')),
	array('label'=>'Create Subscription', 'url'=>array('create')),
	array('label'=>'Update Subscription', 'url'=>array('update', 'id'=>$model->subscribe_id)),
	array('label'=>'Delete Subscription', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->subscribe_id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Subscribe #<?php echo $model->subscribe_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'subscribe_id',
		'subscribe_email',
	),
)); ?>
