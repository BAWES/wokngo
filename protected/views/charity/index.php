<?php
/* @var $this CharityController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Charities',
);

$this->menu=array(
	array('label'=>'Create Charity', 'url'=>array('create')),
	array('label'=>'Manage Charity', 'url'=>array('admin')),
);
?>

<h1>Charities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
