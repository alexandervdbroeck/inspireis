<?php
include_once "autoload.php";

$userid = $_SESSION['usr']['usr_id'];
$postid = $_GET['postid'];
$checkuser = $_GET['userid'];
if($userid==$checkuser){
    $sql = SqlImages($postid);
    $data = GetData($sql);
    /*--------------------foto's verwijderen van de server---------------------*/
    foreach ( $data as $row )
    {
        foreach($row as $field => $value)
        {
            $value = "../".$value;
        }
    }
    /*---------------------blog, comments, en foto's uit de database verwijderen---*/
    $sql = SqlDeleteBlog($postid);
    if(ExecuteSQL($sql)){
    $_SESSION["message"] = "uw blog is verwijderd";
    header("Location: ../profiel.php");

    }else{
    $_SESSION["message"] = "er liep iets mis met het het verwijderen van uw blog";
    header("Location: ../profiel.php");

    }

}else{
    $_SESSION["message"] = "er liep iets mis met het het verwijderen van uw blog";
    header("Location: ../profiel.php");
}