<?php
/* @var $this ProfileController */
/* @var $user Customer */

$this->pageTitle=Yii::app()->name . ' - '.$user->customer_name;
$this->pageHeader = "Profile";
?>

<h1>Welcome <?php echo $user->customer_name; ?></h1>
<ul>
    <li><a href='#changePw'>Change Password</a></li>
    <li><a href='<?php echo Yii::app()->createUrl('site/logout');?>'>Logout</a></li>
</ul>
<h2>My Boxes</h2><br/>

<table>
<?php foreach($user->items as $box){ ?>
    <tr>
        <td>
            <img src='<?php echo $box->image; ?>' style='width:50px; height:50px;'/>
        </td>
        <td>
            <a href="<?php echo Yii::app()->createUrl('box/view',array('seo'=>$box->item_seo_name)); ?>">
                <?php echo $box->item_name; ?>
            </a>
        </td>
        <td>
            <?php echo $box->item_description; ?>
        </td>
    </tr>
<?php } ?>
</table>