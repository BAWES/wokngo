<?php
/* @var $this ApprovalController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Approvals',
);

$this->menu=array(
	array('label'=>'Create Approval', 'url'=>array('create')),
	array('label'=>'Manage Approval', 'url'=>array('admin')),
);
?>

<h1>Approvals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
