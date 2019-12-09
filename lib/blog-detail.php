<?php

require_once "autoload.php";

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

function CommentForm($userid,$postid) {
    $temp = LoadTemplate("blog-bericht-comment");
    $temp = str_replace("@@usr_id@@",$userid,$temp);
    $temp = str_replace("@@post_id@@",$postid,$temp);
    return $temp;

}

function BlogTekst($postid){

    $sql = SqlBlogItems($postid);
    $row = GetDataOneRow($sql);
    $temp = LoadTemplate("blog-bericht");
    $temp = ReplaceContentOneRow($row,$temp);
    return $temp;
}

function Commentaren($blogid){
        $temp = LoadTemplate('blog-bericht-comment-overview');
        $sql = SqlCommentSearch($blogid);
        $data= GetData($sql);
        $temp = ReplaceContent($data,$temp);
        return $temp;
}
