<?php
include_once "autoload.php";


function SqlRegisterUserCheckEmail($useremail){
    $sql = "SELECT * FROM user WHERE usr_email='" .$useremail . "' ";
    return $sql;
}



function SqlBlogItems($blogid){
    $sql = "select post_id, post_blog, post_title, post_user_id ,(select afbeelding.afb_locatie from afbeelding where afb_post_id=".$blogid."  limit 1) as afbeelding
from post where post_id=".$blogid;
    return $sql;
}