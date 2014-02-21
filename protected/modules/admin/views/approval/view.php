<?php
/* @var $this ApprovalController */
/* @var $model Approval */

$this->breadcrumbs=array(
	'Approvals'=>array('index'),
	$model->approval_id,
);

$this->menu=array(
	array('label'=>'List Approval', 'url'=>array('index')),
	array('label'=>'Create Approval', 'url'=>array('create')),
	array('label'=>'Update Approval', 'url'=>array('update', 'id'=>$model->approval_id)),
	array('label'=>'Delete Approval', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->approval_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Approval', 'url'=>array('admin')),
);
?>

<h1>View Approval #<?php echo $model->approval_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'approval_id',
		'item_id',
		'approval_type',
		'approval_text',
	),
)); ?>
