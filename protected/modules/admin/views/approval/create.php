<?php
/* @var $this ApprovalController */
/* @var $model Approval */

$this->breadcrumbs=array(
	'Approvals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Approval', 'url'=>array('index')),
	array('label'=>'Manage Approval', 'url'=>array('admin')),
);
?>

<h1>Create Approval</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>