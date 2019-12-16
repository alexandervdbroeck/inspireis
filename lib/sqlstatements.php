<?php
require_once "autoload.php";

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


/*--------------------------post creeer/ delete / update--------------------------*/
function SqlPostInsert($tablename,$blogtekst,$date){
    $sql = "INSERT INTO $tablename SET " .
        " post_title='" . htmlentities($_POST['post_title'], ENT_QUOTES) . "' , " .
        " post_blog='". $blogtekst."' , " .
        " post_stad_naam='" . htmlentities($_POST['post_stad_naam'], ENT_QUOTES) . "' , " .
        " post_user_id='" . $_SESSION['usr']['usr_id'] . "' , " .
        " post_datum='" . $date . "' , " .
        " post_cat_id='" . $_POST['cat_naam'] . "', ".
        " post_land_id='" . $_POST['land_id'] . "' ";
    return $sql;
}


function SqlPostDelete($postid){
    $sql = "delete from afbeelding
            where afb_post_id =".$postid.";
            delete from commentaar
            where com_post_id = ".$postid.";
            delete from post
            where post_id = ".$postid;
    return $sql;
}

function SqlPostUpdate($post_id,$post_blog,$post_cat,$post_land,$post_stad,$post_title){
    $sql = "update post set
            post_blog = '".$post_blog."',
            post_cat_id =".$post_cat.",
            post_land_id =".$post_land.",
            post_stad_naam ='".$post_stad."',
            post_title='".$post_title."'                    
            where post_id =".$post_id;
    return $sql;
}
function SqlPostGetPostid($user_id){
    $sql = "SELECT post_id FROM post WHERE post_user_id ='".$user_id."' 
                                    order by post_id desc limit 1" ;
    return $sql;
}

function SqlDeleteImage($value){
    $sql = "DELETE FROM afbeelding WHERE afb_filename='".$value."'";
    return $sql;
};

function SqlSearchImage($value){
    $sql = "SELECT afb_filename, afb_locatie FROM afbeelding WHERE afb_filename='".$value."'";
    return $sql;
};



/* ----------------------------------------DETAIL PAGINA------------------------------------------------------*/

        /*voeg een volgen toe */
function SQLDetailAddFollow($followuser, $userid){
    $sql= "INSERT INTO volgers SET volg_user_id=".$userid.",
        volg_volgt_user_id=".$followuser;
    return $sql;
}


function SQLDetailUnFollow($followuser, $userid){
    $sql= "delete from volgers
where volg_user_id =".$userid." and volg_volgt_user_id =".$followuser;
    return $sql;
}

function SqlBlogItems($blogid){
    $sql = "select post_id, post_blog, post_title, land_naam,cat_naam,post_stad_naam,post_user_id ,(select afbeelding.afb_locatie from afbeelding where afb_post_id=".$blogid."  limit 1) as afbeelding
            from post
            inner join landen l on post.post_land_id = l.land_id
            inner join category c on post.post_cat_id = c.cat_id
where post_id=".$blogid;

    return $sql;
}

function SqlInspireerUpdateSearch($blogid){
    $sql = "select post_id, post_blog, post_title, post_cat_id, post_land_id, post_stad_naam, post_user_id
            from post where post_id=".$blogid;
    return $sql;
}

function SqlProfielPolaroid($usrid){
    $sql = "select post_title, post_id, post_user_id, afb_locatie, post_datum, land_naam
            from post p
            inner join afbeelding a on p.post_id = a.afb_post_id
            inner join landen l on p.post_land_id = l.land_id
            where post_user_id =".$usrid."
            group by post_id
            order by post_id desc";
    return $sql;
}

function SqlImagesNotFirst($blogid){

    $sql = "select afb_locatie
            from afbeelding
            where afb_post_id =".$blogid." 
            and afb_filename not like '%_1.%'";
    return$sql;
}

function SqlPostImages($blogid){

    $sql = "select afb_locatie, afb_filename
            from afbeelding
            where afb_post_id =".$blogid;
    return $sql;
}

function SqlDetailCountFolowers($user_id){
    $sql= "select count(*) as volgt, (select count(*)from volgers where volg_volgt_user_id =". $user_id.")as aantalvolgers from volgers
            where volg_user_id =". $user_id;
    return $sql;
}

function SqlDetailCountPosts($user_id){
    $sql = "select count(*) as post, usr_naam, usr_voornaam, usr_login from post
            inner join user u on post.post_user_id = u.usr_id
            where post_user_id =".$user_id;
    return $sql;
}

function SqlDetailCheckFollow($userid, $followuser){
    $sql= "select count(*) as follow from volgers
            where volg_user_id =".$userid."  and volg_volgt_user_id =".$followuser;
    return $sql;
}


/*      Comment formulier  ---------------------------------------------------------*/

function SqlCommentAdd($user_id, $post_id, $tekst){
    $date = new DateTime('NOW', new DateTimeZone('Europe/Brussels'));
    $date = $date->format('d-m-Y');

    $sql= "INSERT INTO commentaar SET com_user_id=".$user_id.",
        com_post_id=".$post_id.", com_tekst='".$tekst."', com_datum='".$date."'";
    return $sql;
}
function SqlCommentSearch( $post_id){
    $sql= "select com_tekst, com_datum, usr_login
from commentaar
inner join user u on commentaar.com_user_id = u.usr_id
where com_post_id =".$post_id."
order by com_id desc";
    return $sql;
}

/* index pagina----------------------------------- -------------------------------------*/
function SqlIndexPolaroid($user_id, $offset, $maxpolaroid){
    $sql = "select  usr_login, usr_id,post_title, post_id, post_datum, land_naam,afb_locatie, post_user_id from volgers
            inner join user u on volgers.volg_volgt_user_id = u.usr_id
            inner join post p on u.usr_id = p.post_user_id
            inner join landen l on p.post_land_id = l.land_id
            inner join afbeelding a on p.post_id = a.afb_post_id
            where volg_user_id =".$user_id."
            group by post_id
            order by post_id desc limit ".$maxpolaroid." offset ".$offset;
    return $sql ;
}


/*ZOEKBAR ONTDEK ----------------------------------------------------------------------------------------------*/

function SQLSearchCatOntdek(){
    $sql = "select cat_id, cat_naam from category;";
    return $sql;
}

function SqlSearchLandOntdek(){
    $sql= "select land_id, land_naam from landen;";
    return $sql;
}

/*Zoekbar: Niks ingevuld*/
function SqlOntdekNoSearch(){
    $sql="select post_title, post_id, afb_locatie , post_user_id,(select land_naam from landen where land_id = post_land_id)as land_naam
        from post
        inner join afbeelding a on post.post_id = a.afb_post_id
        
        group by post_id
        order by post_id desc limit 27";
    return $sql;
}


/*Zoekbar: Land en categorie ingevuld*/
        function SqlOntdekSearchLandCat($land_id, $cat_id){
            $sql ="select  post_title, post_id, afb_locatie, post_user_id,land_naam
        from post
        inner join afbeelding a on post.post_id = a.afb_post_id
        inner join landen l on post.post_land_id = l.land_id
        inner join category c on post.post_cat_id = c.cat_id
        where post_land_id=".$land_id." and post_cat_id =".$cat_id."
        group by post_id;
        order by post_id desc limit 40";
    return $sql;
}

/*Zoekbar: Enkel Land ingevuld*/
function SqlOntdekSearchLand($land_id){
    $sql="select  post_title, post_id, afb_locatie, post_user_id,(select land_naam from landen where land_id = post_land_id)as land_naam
from post
inner join afbeelding a on post.post_id = a.afb_post_id
inner join landen l on post.post_land_id = l.land_id
where post_land_id=".$land_id."
group by post_id;";
    return $sql;
}

/*Zoekbar: Enkel Category ingevuld*/
function SqlOntdekSearchCat($cat_id){
    $sql="select  post_title, post_id, afb_locatie,post_user_id,(select land_naam from landen where land_id = post_land_id)as land_naam
from post
inner join afbeelding a on post.post_id = a.afb_post_id
inner join category c on post.post_cat_id = c.cat_id
where post_cat_id=".$cat_id."
group by post_id;";
    return $sql;
}


/*error messages-----------------------*/

function SqlError($postid,$error){
    $sql = "INSERT INTO error SET
            error_discription = '".$error."',
            error_usr_id=".$_SESSION['usr']['usr_id'].",
            error_post_id=".$postid;
    return $sql;
}





