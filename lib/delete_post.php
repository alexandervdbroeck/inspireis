<?php
include_once "autoload.php";

$userid = $_SESSION['usr']['usr_id'];
$postid = $_GET['postid'];
$checkuser = $_GET['userid'];
if($userid==$checkuser){
    $sql = SqlImages($postid);
    $data = GetData($sql);
    var_dump($data);
    foreach ( $data as $row )
    {
        foreach($row as $field => $value)
        {
            unlink($value);
            var_dump($value);
        }
    }

    die;
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