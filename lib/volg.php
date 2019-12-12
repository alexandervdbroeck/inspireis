<?php
//Insert Data
require_once "autoload.php";
//iemand volgen:
if (isset($_GET['userid'])){
    /*check welke gebruiker gevolgd dient te worden*/
    $blog_id= $_GET['blog'];
    $followuser= $_GET['userid'];
    $userid = $_SESSION['usr']['usr_id'];

    /* invoeren in de database*/
    $sql = SQLBlogITemsAddFollow($followuser,$userid);
    ExecuteSQL($sql);
    /* terug naar de juiste detail pagina*/
    header ("location:../blog_item.php?blogid=".$blog_id."&userid=".$followuser);

}
// iemand niet meer volgen
if(isset($_GET['unfollow'])){
    $blog_id= $_GET['blog'];
    $followuser= $_GET['userid'];
    $userid = $_SESSION['usr']['usr_id'];

    /* invoeren in de database*/
    $sql = SQLBlogITemsUnFollow($followuser,$userid);
    ExecuteSQL($sql);
    /* terug naar de juiste detail pagina*/
    header ("location:../blog_item.php?blogid=".$blog_id."&userid=".$followuser);

}
if(isset($_GET['addcomment'])){


}
function CheckFollow($postuser){
    $sql = SqlBlogItemsCheckFollow($_SESSION['usr']['usr_id'],$postuser);
    $row = GetDataOneRow($sql);
    if($row['follow'] > 0){
        return true;
    }else {return false;}

}

echo "hello world";

