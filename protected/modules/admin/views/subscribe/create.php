<?php
/* @var $this SubscribeController */
/* @var $model Subscribe */

$this->breadcrumbs=array(
	'Subscribes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Subscriptions', 'url'=>array('index')),
);
?>

<h1>Create Subscribe</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>