<?php
/* @var $this SubscribeController */
/* @var $model Subscribe */

$this->breadcrumbs=array(
	'Subscribes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Subscription', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#subscribe-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Subscribes</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'subscribe-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'subscribe_id',
		'subscribe_email',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
