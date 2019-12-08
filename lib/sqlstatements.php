<?php
include_once "autoload.php";

/* registratie formulier------------------------------------------*/
function SqlRegisterUserCheckEmail($useremail){
    $sql = "SELECT * FROM user WHERE usr_email='" .$useremail . "' ";
    return $sql;
}

function SqlRegisterUserCheckLogin($login){
    $sql = "SELECT * FROM user WHERE usr_login='" . $login. "' ";
    return $sql;
}

function SqlRegisterUserInsertUser($voornaam,$naam,$email,$pasw,$login,$tablename){
    $sql = "INSERT INTO $tablename SET " .
        " usr_voornaam='" . htmlentities($voornaam, ENT_QUOTES) . "' , " .
        " usr_naam='" . htmlentities($naam, ENT_QUOTES) . "' , " .
        " usr_email='" . $email. "' , " .
        " usr_paswoord='" .$pasw . "', ".
        " usr_login='".$login."'";
    return $sql;
}

/* blog-items pagina--------------------------------------------------------------*/
function SqlBlogItemsGetUserId($blogid){
    $sql = "select  post_user_id 
from post where post_id=".$blogid;
    return $sql;

}

function SqlBlogItems($blogid){
    $sql = "select post_id, post_blog, post_title, post_user_id ,(select afbeelding.afb_locatie from afbeelding where afb_post_id=".$blogid."  limit 1) as afbeelding
from post where post_id=".$blogid;
    return $sql;
}



