<?php
/* @var $this ProfileController */
/* @var $user Customer */

$this->pageTitle = Yii::app()->name . ' - ' . $user->customer_name;
$this->pageHeader = "Profile";
?>

<h1>Welcome <?php echo $user->customer_name; ?></h1>
<ul>
    <li><a href='<?php echo Yii::app()->createUrl('profile/changePassword'); ?>'>Change Password</a></li>
    <li><a href='<?php echo Yii::app()->createUrl('site/logout'); ?>'>Logout</a></li>
</ul>
<h2>My Boxes</h2><br/>

<table style="width:100%;">
    <?php foreach ($user->items as $box) { ?>
        <tr>
            <td style="width:60px;">
                <a href="<?php echo Yii::app()->createUrl('box/view', array('seo' => $box->item_seo_name)); ?>">
                    <img src='<?php echo $box->image; ?>' style='width:50px; height:50px;'/>
                </a>
            </td>
            <td>
                <a href="<?php echo Yii::app()->createUrl('box/view', array('seo' => $box->item_seo_name)); ?>">
                    <?php echo $box->item_name; ?>
                </a>
            </td>
            <td><a href="<?php echo Yii::app()->createUrl('profile/changeLogo', array('id' => $box->item_id)); ?>">Change Photo</a></td>
            <td><a href="<?php echo Yii::app()->createUrl('profile/changeDescription', array('id' => $box->item_id)); ?>">Add Description</a></td>
        </tr>
    <?php } ?>
</table>