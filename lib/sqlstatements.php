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
//function SqlBlogItemsGetUserId($blogid){
//    $sql = "select  post_user_id
//from post where post_id=".$blogid;
//    return $sql;
//
//}

function SQLBlogITemsAddFollow($followuser,$userid){
    $sql= "INSERT INTO volgers SET volg_user_id=".$userid.",
        volg_volgt_user_id=".$followuser;
    return $sql;
}


function SQLBlogITemsUnFollow($followuser,$userid){
    $sql= "delete from volgers
where volg_user_id =".$userid." and volg_volgt_user_id =".$followuser;
    return $sql;
}

function SqlBlogItems($blogid){
    $sql = "select post_id, post_blog, post_title, post_user_id ,(select afbeelding.afb_locatie from afbeelding where afb_post_id=".$blogid."  limit 1) as afbeelding
            from post where post_id=".$blogid;
    return $sql;
}
function SqlBlogItemsSearchVolgers($user_id){
    $sql= "select count(*) as volgt, (select count(*)from volgers where volg_volgt_user_id =". $user_id.")as aantalvolgers from volgers
            where volg_user_id =". $user_id;
    return $sql;
}

function SqlBlogItemsCountPost($user_id){
    $sql = "select count(*) as post, usr_voornaam, usr_naam from post
            inner join user u on post.post_user_id = u.usr_id
            where post_user_id =".$user_id;
    return $sql;
}

function SqlBlogItemsCheckFollow($userid, $followuser){
    $sql= "select count(*) as follow from volgers
            where volg_user_id =".$userid."  and volg_volgt_user_id =".$followuser;
    return $sql;
}


