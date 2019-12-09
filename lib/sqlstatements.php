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

function SqlRegisterUserInsertUser($voornaam,$naam,$email,$pasw,$login,$tablename,$believe){
    $sql = "INSERT INTO $tablename SET " .
        " usr_voornaam='" . htmlentities($voornaam, ENT_QUOTES) . "' , " .
        " usr_naam='" . htmlentities($naam, ENT_QUOTES) . "' , " .
        " usr_email='" . $email. "' , " .
        " usr_paswoord='" .$pasw . "', ".
        " usr_believer=" .$believe . ", ".
        " usr_login='".$login."'";
    return $sql;
}


/*--------------------------post creeer/ delete / update--------------------------*/

function SqlDeleteBlog($postid){
    $sql = "delete from afbeelding
            where afb_post_id =".$postid.";
            delete from commentaar
            where com_post_id = ".$postid.";
            delete from post
            where post_id = ".$postid;
    return $sql;
}


/* -------------------------blog-items pagina-----------------------------------------*/
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

function SqlBlogItemsProfile($usrid){
    $sql = "select post_title, post_id, post_user_id, afb_locatie
            from post
            inner join afbeelding a on post.post_id = a.afb_post_id
            where post_user_id =".$usrid."
            group by post_id";
    return $sql;
}

function SqlImagesNotFirst($blogid){

    $sql = "select afb_locatie
            from afbeelding
            where afb_post_id =".$blogid." 
            and afb_filename not like '%_1.%'";
    return$sql;
}

function SqlImages($blogid){

    $sql = "select afb_locatie
            from afbeelding
            where afb_post_id =".$blogid;
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


/*      Comment formulier  ---------------------------------------------------------*/

function SqlCommentAdd($user_id, $post_id, $tekst){
    $sql= "INSERT INTO commentaar SET com_user_id=".$user_id.",
        com_post_id=".$post_id.", com_tekst='".$tekst."'";
    return $sql;
}
function SqlCommentSearch( $post_id){
    $sql= "select com_tekst, com_datum, usr_login
from commentaar
inner join user u on commentaar.com_user_id = u.usr_id
where com_post_id =".$post_id."
order by com_datum desc";
    return $sql;
}

/* index pagina----------------------------------- -------------------------------------*/
function SqlTegelHome($user_id){
    $sql = "select  usr_login, usr_id,post_title, post_id, post_datum, afb_locatie from volgers
            inner join user u on volgers.volg_volgt_user_id = u.usr_id
            inner join post p on u.usr_id = p.post_user_id
            inner join afbeelding a on p.post_id = a.afb_post_id
            where volg_user_id =".$user_id."
            group by post_id";
    return $sql ;
}

function SqlTegelOntdek($user_id){
    $sql="select  usr_id, post_title, post_id, afb_locatie 
        from user 
        inner join post p on user.usr_id = p.post_user_id
        inner join afbeelding a on p.post_id = a.afb_post_id
        group by post_id";
    return $sql;
}



