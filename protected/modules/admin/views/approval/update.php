<?php
/* @var $this ApprovalController */
/* @var $model Approval */

$this->breadcrumbs=array(
	'Approvals'=>array('index'),
	$model->approval_id=>array('view','id'=>$model->approval_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Approval', 'url'=>array('index')),
	array('label'=>'Create Approval', 'url'=>array('create')),
	array('label'=>'View Approval', 'url'=>array('view', 'id'=>$model->approval_id)),
	array('label'=>'Manage Approval', 'url'=>array('admin')),
);
?>

<h1>Update Approval <?php echo $model->approval_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>