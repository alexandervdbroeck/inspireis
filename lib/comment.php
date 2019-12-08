<?php

require_once "autoload.php";

$formname = $_POST["formname"];
$tablename = $_POST["tablename"];
var_dump($_POST);
var_dump($_POST);
unset($_SESSION['message']);
// controle op formulier
if ($formname == "comment" AND $_POST['submit'] == "Reageer") {
    $usr_id = $_SESSION['usr']['usr_id'];
    $post_id = $_POST['post_id'];
    $tekst = $_POST['commentaar'];
    $sql = SqlCommentAdd($usr_id,$post_id,$tekst);
    if(!ExecuteSQL($sql))$_SESSION['message']= "Er liep iets mis met het opslaan van uw comment";
    $usr_id = $_POST['usr_id'];
    header ("location:../blog_item.php?blogid=".$post_id."&userid=".$usr_id);

}