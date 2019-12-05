<?php

require_once "autoload.php";

$formname = $_POST["formname"];
$tablename = $_POST["tablename"];
$user_id = $_SESSION['usr']['usr_id'];
unset($_SESSION['message']);
// controle of het juiste formulier aankomt
if ($formname == "creeer_form" AND $_POST['submitpost'] == "save_post") {
    // sql statement samenstellen
    $sql = "INSERT INTO $tablename SET " .
        " post_title='" . htmlentities($_POST['post_title'], ENT_QUOTES) . "' , " .
        " post_blog='" . htmlentities($_POST['post_blog'], ENT_QUOTES) . "' , " .
        " post_stad_naam='" . htmlentities($_POST['post_stad_naam'], ENT_QUOTES) . "' , " .
        " post_user_id='" . $_SESSION['usr']['usr_id'] . "' , " .
        " post_cat_id='" . $_POST['cat_naam'] . "', ".
        " post_land_id='" . $_POST['land_id'] . "' ";
    // Post in database opslaan
    if (ExecuteSQL($sql)){
        $_SESSION['message']= "uw blog is gepost";
        $_SESSION['blogtext']= $_POST['post_blog'];
       // header ("location:../creeer.php");
    }else {
        $_SESSION['message']= "er liep iets mis";
       // header ("location:../creeer.php");
    }
    // om de afbeelding een naam te geven, eerst de net gecreeerde post_id ophalen
    $sql = "SELECT post_id FROM post WHERE post_user_id ='".$user_id."' 
                                    order by post_datum desc limit 1" ;
    $post_id = GetDataOneRow($sql );
    $post_id = $post_id['post_id'];

    //directory samenstellen om foto's in op te slaan (images/user_XX/) en als deze niet bestaad aanmaken

    if(!is_dir("../images/user_".$user_id))mkdir("../images/user_".$user_id);
    $target_dir = "../images/user_".$user_id."/";

    // controleren hoeveel foto's er toegevoegd moeten worden
    $countfiles = count($_FILES["filename"]["name"]);

    // een lijst aanmaken om de namen van de foto's in op te slaan
    $fotos = array();

    // files stuk voor stuk downloaden
    for($i=0;$i<$countfiles;$i++){
        // foto herbenoemen naar (postid_fotonr) in lowercase letters
        $filename = strtolower($_FILES["filename"]["name"][$i]) ;
        $fileExplode = explode(".",$filename);
        $fileExt = end($fileExplode);
        //fotonr creeren aan de hand van de $i
        $fotonr = $i+1;
        $_FILES["filename"]["name"][$i] = $post_id."_".$fotonr.".".$fileExt;
        // filename  aan lijst toevoegen voor later gebruik(in database invoer)
        array_push($fotos,$_FILES["filename"]["name"][$i]);
        $target_file = $target_dir.basename($_FILES["filename"]["name"][$i]);
        // de foto uploaden in zijn usermap
        move_uploaded_file($_FILES["filename"]["tmp_name"][$i],$target_file);
    }

    // fotos in database zetten aan de hand

    for($i=0;$i<$countfiles;$i++){
        $sql = "INSERT INTO afbeelding SET afb_post_id =". $post_id.",afb_filename='".$fotos[$i]."', afb_locatie= 'images/user_".$user_id."/".$fotos[$i]."'";
        ExecuteSQL($sql);

    }

}
