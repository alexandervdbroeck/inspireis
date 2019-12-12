<?php

require_once "autoload.php";
$formname = $_POST["formname"];
$tablename = $_POST["tablename"];

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


function GetFollowersAndFollowButton($userid,$postid) {
    $sql = SqlBlogItemsSearchVolgers($userid);
    $row = GetDataOneRow($sql);
    $temp = LoadTemplate("blog-bericht-volgers");
    $temp = ReplaceContentOneRow($row,$temp);
    /*samenstellen hoeveel post's en naam vd blogger*/
    $sql = SqlBlogItemsCountPost($userid);
    $row = GetDataOneRow($sql);
    $temp = ReplaceContentOneRow($row,$temp);
 /*template*/
    $sql = SqlBlogItemsCheckFollow($_SESSION['usr']['usr_id'],$userid);
    $row = GetDataOneRow($sql);
    /* als de user nog niet gevold wordt print de volg knop*/
    if($row['follow'] == 0){
        $blogid = $_GET['blogid'];
        $userid = $_GET['userid'];
        $followbutton =LoadTemplate("blog-bericht-follow");
        $followbutton = str_replace("@@blog_id@@", $blogid, $followbutton);
        $followbutton = str_replace("@@user_id@@", $userid, $followbutton);
        $temp = str_replace("@@follow@@", $followbutton,$temp);
        return $temp;

    }else {
        /*als de user reeds gevolgd wordt print de ontvolg knop*/
        $blogid = $_GET['blogid'];
        $userid = $_GET['userid'];
        $followbutton =LoadTemplate("blog-bericht-unfollow");
        $followbutton = str_replace("@@blog_id@@", $blogid, $followbutton);
        $followbutton = str_replace("@@user_id@@", $userid, $followbutton);
        $temp = str_replace("@@follow@@", $followbutton,$temp);
        return $temp;

    }
}

function GetFollowers($usrid) {
    $sql = SqlBlogItemsSearchVolgers($usrid);
    $row = GetDataOneRow($sql);
    $temp = LoadTemplate("profiel-volgers");
    $temp = ReplaceContentOneRow($row,$temp);
    /*samenstellen hoeveel post's en naam vd blogger*/
    $sql = SqlBlogItemsCountPost($usrid);
    $row = GetDataOneRow($sql);
    $temp = ReplaceContentOneRow($row,$temp);
    return $temp;

}

function CommentForm($userid,$postid) {
    $temp = LoadTemplate("blog-bericht-comment");
    $temp = str_replace("@@usr_id@@",$userid,$temp);
    $temp = str_replace("@@post_id@@",$postid,$temp);
    $com = LoadTemplate('blog-bericht-comment-overview');
    $sql = SqlCommentSearch($postid);
    $data= GetData($sql);
    $com = ReplaceContent($data,$com);
    $temp = str_replace("@@comment@@",$com,$temp);
    return $temp;

}

function BlogTekst($postid){

    $sql = SqlBlogItems($postid);
    $row = GetDataOneRow($sql);
    $temp = LoadTemplate("blog-bericht");
    $temp = ReplaceContentOneRow($row,$temp);
    /* als je er voor gekozen hebt om maar 1 foto te kunnen zien, wordt dit hier gecheckt*/
    if($_SESSION['usr']['usr_believer']==0){
        $sql = SqlImagesNotFirst($postid);
        $data = GetData($sql);
        if(count($data)==1){
            $temp = str_replace("@@image@@","<p>er is maar 1 afbeelding</p>",$temp);
            return $temp;
        }
        $afb = LoadTemplate('image');
        $afb = ReplaceContent($data,$afb);
        $temp = str_replace("@@image@@",$afb,$temp);
        return $temp;
        } else{
        $temp = str_replace("@@image@@","<p>u are a believer</p>",$temp);
        return $temp;} }



function Commentaren($blogid){
        $temp = LoadTemplate('blog-bericht-comment-overview');
        $sql = SqlCommentSearch($blogid);
        $data= GetData($sql);
        $temp = ReplaceContent($data,$temp);
        return $temp;
}


