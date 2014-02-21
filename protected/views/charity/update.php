<?php
/* @var $this CharityController */
/* @var $model Charity */

$this->breadcrumbs=array(
	'Charities'=>array('index'),
	$model->charity_id=>array('view','id'=>$model->charity_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Charity', 'url'=>array('index')),
	array('label'=>'Create Charity', 'url'=>array('create')),
	array('label'=>'View Charity', 'url'=>array('view', 'id'=>$model->charity_id)),
	array('label'=>'Manage Charity', 'url'=>array('admin')),
);
?>

<h1>Update Charity <?php echo $model->charity_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>