<?php

require_once "autoload.php";

/*--------------------------bovernaan formulieren onderaan functies------------------------------------------------*/

/*----------------Post variabelen-----------------------------------------------------------------------------------*/

$formname = $_POST["formname"];
$tablename = $_POST["tablename"];

/*--------------------------------------------comment fromulier---------------------------------------------------*/
// controle op formulier
if ($formname == "comment" AND $_POST['submit'] == "Reageer") {
    $usr_id = $_SESSION['usr']['usr_id'];
    $post_id = $_POST['post_id'];
    $tekst = $_POST['commentaar'];
    $sql = SqlCommentAdd($usr_id,$post_id,$tekst);
    if(!ExecuteSQL($sql))$_SESSION['error']= "Er liep iets mis met het opslaan van uw comment";
    $usr_id = $_POST['usr_id'];
    header ("location:../detail.php?blogid=".$post_id."&userid=".$usr_id);

}

/*--------------------------------functies--------------------------------------------------------------------*/





function DetailUserStatusAndFollowButton($userid, $blogid) {

    // eerst samenstellen van van de user status template

    $sql = SqlDetailCountFolowers($userid);
    $row = GetDataOneRow($sql);
    $temp = LoadTemplate("detail_follow_status");
    $temp = ReplaceContentOneRow($row,$temp);

    /*samenstellen hoeveel post's en naam vd blogger*/

    $sql = SqlDetailCountPosts($userid);
    $row = GetDataOneRow($sql);
    $temp = ReplaceContentOneRow($row,$temp);

    $sql = SqlDetailCheckFollow($_SESSION['usr']['usr_id'],$userid);
    $row = GetDataOneRow($sql);

    // als de user nog niet gevolgd wordt wordt de volg knop geprint anders de ontvolg knop

    if($row['follow'] == 0){

        $followbutton =LoadTemplate("detail_button_follow");
        $followbutton = str_replace("@@blog_id@@", $blogid, $followbutton);
        $followbutton = str_replace("@@user_id@@", $userid, $followbutton);
        $temp = str_replace("@@follow@@", $followbutton,$temp);
        return $temp;

    }else {

        /*als de user reeds gevolgd wordt , de ontvolgknop printen*/

        $followbutton =LoadTemplate("detail_button_unfollow");
        $followbutton = str_replace("@@blog_id@@", $blogid, $followbutton);
        $followbutton = str_replace("@@user_id@@", $userid, $followbutton);
        $temp = str_replace("@@follow@@", $followbutton,$temp);
        return $temp;

    }
}

function ProfielUserStatus($usrid) {
    $sql = SqlDetailCountFolowers($usrid);
    $row = GetDataOneRow($sql);
    $temp = LoadTemplate("profiel_follow_status");
    $temp = ReplaceContentOneRow($row,$temp);
    /*samenstellen hoeveel post's en naam vd blogger*/
    $sql = SqlDetailCountPosts($usrid);
    $row = GetDataOneRow($sql);
    $temp = ReplaceContentOneRow($row,$temp);
    return $temp;

}

function CommentForm($userid,$postid) {

     // samenstellen van het formulier om comment toe te voegen

    $temp = LoadTemplate("detail_comment_form");
    $temp = str_replace("@@usr_id@@",$userid,$temp);
    $temp = str_replace("@@post_id@@",$postid,$temp);
    $com = LoadTemplate('detail_comment');
    $sql = SqlCommentSearch($postid);
    $data= GetData($sql);
    $com = ReplaceContent($data,$com);
    $temp = str_replace("@@comment@@",$com,$temp);
    return $temp;

}

function BlogTekst($postid){

    $sql = SqlBlogItems($postid);
    $row = GetDataOneRow($sql);
    $temp = LoadTemplate("detail_blog");
    $temp = ReplaceContentOneRow($row,$temp);

    /* functie reeds voorzien dat users kunnen kiezen om 1 of meerder foto's te kunnen zien
    voorlopig worden alle users zo aangemaakt dat ze alle foto's te zien krijgen.. wordt vervolgd*/

    // de template wordt aangevuld met de bijhorende foto's (behalve de eerste foto die bovenaan de pagina staat)

    if($_SESSION['usr']['usr_believer']==0){
        $sql = SqlImagesNotFirst($postid);
        $data = GetData($sql);

        // als er maar 1 image is wordt het bericht gegenereerd dat er maar 1 foto is

        if(count($data)==0){
            $temp = str_replace("@@image@@","<p>er is maar 1 afbeelding</p>",$temp);
            return $temp;
        }
        $afb = LoadTemplate('detail_extra_image');
        $afb = ReplaceContent($data,$afb);
        $temp = str_replace("@@image@@",$afb,$temp);
        return $temp;
        } else{
        /* in de toekomst als mensen er voor kiezen om maar 1 foto te kunnen zien wordt volgend bericht geprint als er meerdere
        foto's zouden zijn*/


        $temp = str_replace("@@image@@","<p>u are a believer</p>",$temp);
        return $temp;} }




