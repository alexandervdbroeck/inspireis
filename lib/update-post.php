<?php
require_once "autoload.php";
$userid = $_SESSION['usr']['usr_id'];
$formname = $_POST['formname'];

if ($formname == "update_form" AND $_POST['submitpost'] == "update" AND $userid == $_POST['post_usr_id']){
    $post_id = $_POST['post_id'];
    $post_blog = $_POST['post_blog'];
    $post_cat = $_POST['post_cat_id'];
    $post_land = $_POST['post_land_id'];
    $post_stad = $_POST['post_stad_naam'];
    $post_title = $_POST['post_title'];
    $sql =  SqlPostUpdate($post_id,$post_blog,$post_cat,$post_land,$post_stad,$post_title);
    if(ExecuteSQL($sql)){
        $_SESSION['message']= "Uw blog is aangepast";
        header ("location:../blog_item.php?blogid=".$post_id."&userid=".$_SESSION['usr']['usr_id']);
    }else{
        $_SESSION['message']= "Sorry, er is een probleem, uw blogtext is opgeslagen, maar een of meerdere van uw foto's niet";
        header ("location:../creeer.php?postid=".$post_id);
    }

}else{
    $_SESSION['message']= "U was op een pagina waar u geen rechten toe heeft";
    header ("location:../index.php");
};
