<?php
include_once "autoload.php";

function ErrorToDatabase($postid,$error){
    $sql = SqlError($postid,$error);
    ExecuteSQL($sql);

}
