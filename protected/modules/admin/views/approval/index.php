<?php
/* @var $this ApprovalController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Approvals',
);

?>

<h1>Approvals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
