<?php

require_once "autoload.php";

$formname = $_POST["formname"];
$tablename = $_POST["tablename"];
$user_id = $_SESSION['usr']['usr_id'];

if(isset($_GET['postid'])and isset($_GET['userid'])){
    $userid = $_SESSION['usr']['usr_id'];
    $postid = $_GET['postid'];
    $checkuser = $_GET['userid'];
    if($userid==$checkuser){
        $sql = SqlImages($postid);
        $data = GetData($sql);
        /*--------------------foto's verwijderen van de server---------------------*/
        foreach ( $data as $row )
        {
            foreach($row as $field => $value)
            {
                $value = "../".$value;
            }
        }
        /*---------------------blog, comments, en foto's uit de database verwijderen---*/
        $sql = SqlPostDelete($postid);
        if(ExecuteSQL($sql)){
            $_SESSION["message"] = "uw blog is verwijderd";
            header("Location: ../profiel.php");
            die;

        }else{
            $_SESSION["message"] = "er liep iets mis met het het verwijderen van uw blog";
            header("Location: ../profiel.php");
            die;
        }

    }else{
        $_SESSION["message"] = "er liep iets mis met het het verwijderen van uw blog";
        header("Location: ../profiel.php");
        die;
    }
}
if ($formname == "update_form" AND $_POST['submitpost'] == "update" AND $user_id == $_POST['post_usr_id']){
    $post_id = $_POST['post_id'];
    $post_blog = $_POST['post_blog'];
    $post_cat = $_POST['post_cat_id'];
    $post_land = $_POST['post_land_id'];
    $post_stad = $_POST['post_stad_naam'];
    $post_title = $_POST['post_title'];
    $sql =  SqlPostUpdate($post_id,$post_blog,$post_cat,$post_land,$post_stad,$post_title);
    if(ExecuteSQL($sql)){
        $_SESSION['message']= "Uw blog is aangepast";
        header ("location:../detail.php?blogid=".$post_id."&userid=".$_SESSION['usr']['usr_id']);
        die;
    }else{
        $_SESSION['message']= "Sorry, er is een probleem, uw blogtext is opgeslagen, maar een of meerdere van uw foto's niet";
        header ("location:../inspireer.php?postid=".$post_id);
        die;
    }

}else{
    $_SESSION['message']= "U was op een pagina waar u geen rechten toe heeft";
    header ("location:../index.php");
    die;
};





// als er geen error berichten zijn en het juiste formulier binnen gekomen is de blog, en foto's opslaan
if ($formname == "creeer_form" AND $_POST['submitpost'] == "save" AND !isset($_SESSION['message'])) {
    // controleren of er een foto is toegevoegd
    if($_FILES["filename"]["name"][0] == ""){
        $_SESSION['message']= "u moet minimum 1 foto toevoegen,";
        header ("location:../inspireer.php");
        var_dump($_SESSION);
        die;
    }


// check of foto een jpg, png of jpeg is en het formaat van de afbeelding
    $ext_allowed = array(
        "png",
        "jpg",
        "jpeg"
    );
    $countfiles = count($_FILES["filename"]["name"]);
    for($i=0;$i<$countfiles;$i++){
        // foto herbenoemen naar (postid_fotonr) in lowercase letters
        $filename = strtolower($_FILES["filename"]["name"][$i]) ;
        $fileExplode = explode(".",$filename);
        $fileExt = end($fileExplode);
        if (! in_array($fileExt,$ext_allowed)){
            $_SESSION['message']= "u mag enkel jpg, jpeg of png bestanden toevoegen";
            header ("location:../inspireer.php");
            die;

        }
        if ($_FILES['filename']["size"][$i] > 6000000){
            $_SESSION['message']= "een afbeelding mag maximum 6MB zijn";
            header ("location:../inspireer.php");
            die;
        }
    }
    // sql statement samenstellen
    $blogtexst = $_POST['post_blog'];
    $date = new DateTime('NOW', new DateTimeZone('Europe/Brussels'));
    $date = $date->format('d-m-Y');



    $sql = "INSERT INTO $tablename SET " .
        " post_title='" . htmlentities($_POST['post_title'], ENT_QUOTES) . "' , " .
//        " post_blog='" . htmlentities($blogtexst, ENT_QUOTES) . "' , " .
        " post_blog='". $blogtexst."' , " .
        " post_stad_naam='" . htmlentities($_POST['post_stad_naam'], ENT_QUOTES) . "' , " .
        " post_user_id='" . $_SESSION['usr']['usr_id'] . "' , " .
        " post_datum='" . $date . "' , " .
        " post_cat_id='" . $_POST['cat_naam'] . "', ".
        " post_land_id='" . $_POST['land_id'] . "' ";
    // Post in database opslaan
    if (!ExecuteSQL($sql)){
        $_SESSION['message']= "er liep iets mis met het opslaan van uw blog ";
        header ("location:../inspireer.php");

    }


    // om de afbeelding een naam te geven, eerst de net gecreeerde post_id ophalen
    $sql = "SELECT post_id FROM post WHERE post_user_id ='".$user_id."' 
                                    order by post_id desc limit 1" ;
    $post_id = GetDataOneRow($sql );
    $post_id = $post_id['post_id'];

    //directory samenstellen om foto's in op te slaan (images/user_XX/) en als deze niet bestaad aanmaken
    if(!is_dir("../images/user_".$user_id))mkdir("../images/user_".$user_id);
    $target_dir = "../images/user_".$user_id."/";

    // controleren hoeveel foto's er toegevoegd moeten worden
    $countfiles = count($_FILES["filename"]["name"]);

    // een lijst aanmaken om de namen van de foto's in op te slaan(voor in de databank)
    $fotos = array();

    // files stuk voor stuk downloaden naar de images/user_XX map

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
        if(move_uploaded_file($_FILES["filename"]["tmp_name"][$i],$target_file));
        else $_SESSION['message']= "Sorry, er is een probleem, uw blogtext is opgeslagen, maar een of meerdere van uw foto's niet";
        header ("location:../inspireer.php");

    }
    // fotos in database zetten aan de hand

    for($i=0;$i<$countfiles;$i++){
        $sql = "INSERT INTO afbeelding SET afb_post_id =". $post_id.",afb_filename='".$fotos[$i]."', afb_locatie= 'images/user_".$user_id."/".$fotos[$i]."'";
        ExecuteSQL($sql);

    }
    $_SESSION['message']= "Uw blog is opgeslagen";
    header ("location:../detail.php?blogid=".$post_id."&userid=".$_SESSION['usr']['usr_id']);
}

