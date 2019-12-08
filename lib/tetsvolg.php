<?php
//Insert Data
require_once "autoload.php";

/*check welke gebruiker gevolgd dient te worden*/
$blog_id= $_GET['blog'];
$followuser= $_GET['userid'];
$userid = $_SESSION['usr']['usr_id'];

/* invoeren in de database*/
$sql = SQLBlogITemsAddFollow($followuser,$userid);
        ExecuteSQL($sql);
        /* terug naar de juiste detail pagina*/
header ("location:../blog_item.php?blogid=".$blog_id."&userid=".$followuser);

?>