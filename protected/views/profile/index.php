<?php
/* @var $this ProfileController */
/* @var $user Customer */

$this->pageTitle=Yii::app()->name . ' - '.$user->customer_name;
$this->pageHeader = "Profile";
?>

<h1>Welcome <?php echo $user->customer_name; ?></h1>
<ul>
    <li><a href='#changePw'>Change Password</a></li>
    <li><a href='#changePw'>Logout</a></li>
</ul>
<h2>My Boxes</h2><br/>

<table>
<?php foreach($user->items as $box){ ?>
    <tr>
        <td>
            <img src='<?php echo $box->image; ?>'/>
        </td>
        <td>
            <?php echo $box->item_name; ?>
        </td>
    </tr>
<?php } ?>
</table>