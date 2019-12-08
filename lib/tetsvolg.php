<?php
//Insert Data
require_once "autoload.php";

/*check welke gebruiker gevolgd dient te worden*/
$blog_id= $_GET['blog'];
$sql = SqlBlogItemsGetUserId($blog_id);
$row = GetDataOneRow($sql);
/* invoeren in de database*/
$volgt = $row['post_user_id'];
$sql = "INSERT INTO volgers SET volg_user_id=".$_SESSION['usr']['usr_id'].",
        volg_volgt_user_id=".$volgt;
        ExecuteSQL($sql);
header ("location:../blog_item.php?blogid=".$blog_id);





?>