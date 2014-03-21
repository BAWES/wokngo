<?php
/* @var $this SubscribeController */
/* @var $model Subscribe */

$this->breadcrumbs=array(
	'Subscribes'=>array('index'),
	$model->subscribe_id=>array('view','id'=>$model->subscribe_id),
	'Update',
);

$this->menu=array(
	array('label'=>'Manage Subscriptions', 'url'=>array('index')),
	array('label'=>'Create Subscription', 'url'=>array('create')),
	array('label'=>'View Subscription', 'url'=>array('view', 'id'=>$model->subscribe_id)),
);
?>

<h1>Update Subscribe <?php echo $model->subscribe_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>