<?php
/* @var $this SaleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sales',
);

$this->menu=array(
	array('label'=>'Create Sale', 'url'=>array('create')),
	array('label'=>'Manage Sale', 'url'=>array('admin')),
);
?>

<h1>Sales</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
