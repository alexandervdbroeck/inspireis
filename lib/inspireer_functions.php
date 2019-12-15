<?php

/*------------------------------formulieren en GET functies bevinden zich bovenaan ------------------------
 -------------------------------alle functies bevinden zich onderaan -------------------------------------*/

require_once "autoload.php";

/*-------------------------------Post variabelen laden ----------------------------------------------------*/

$formname = $_POST["formname"];
$tablename = $_POST["tablename"];
$user_id = $_SESSION['usr']['usr_id'];
$post_id = $_POST['post_id'];
$post_blog = $_POST['post_blog'];
$post_cat = $_POST['post_cat_id'];
$post_land = $_POST['post_land_id'];
$post_stad = $_POST['post_stad_naam'];
$post_title = $_POST['post_title'];


/*-------------------------------Deleten van een post en afbeeldingen met Get method-----------------------*/

if(isset($_GET['postid'])and isset($_GET['userid'])){
    $userid = $_SESSION['usr']['usr_id'];
    $postid = $_GET['postid'];
    $checkuser = $_GET['userid'];

    //controleren of de het de ingelogde gebruiker is dat zijn blog wilt verwijderen(anti-cheat)

    if($userid==$checkuser){

       // eerst foto's van de server verwijderen//

        DeleteAllPostPicturesDirectory($postid);
        if(DeletePostFromDatabase($postid)){
           $_SESSION['message'] = "Uw post werd verwijderd";
           header ("location:../profiel.php");
           die;
            }else{
            $_SESSION['error'] = "Sorry er liep iets mis met het verwijderen van uw post";
            header ("location:../profiel.php");

            // een error naar de databank versturen

            $error ="Een user probeerde zijn post te verwijderen maar dit lukte niet";
            ErrorToDatabase($postid,$error);
            die;
        }
        }
}


/*---------------------------inspireer create form-----------------------------------------------------*/


if ($formname == "creeer_form" AND $_POST['submitpost'] == "save") {

    // controleren of er een foto is toegevoegd

    if(CheckImages()){

        // post tabel invullen

        InsertDatabasePost($tablename);

        // laatst ingegeven post_id ophalen

        $post_id = GetLatestPostid($user_id);

        // inserts fotos in de juiste directory (images/user_XX/plogid nrfoto.jpeg) en returns een lijst van de file names van de foto's

        $fotos = InsertImagesInDirectory($post_id,$user_id);

        // Fotos in de database opslaan

        InsertImagesDatabase($fotos,$post_id,$user_id);

        $_SESSION['message']= "Uw blog is opgeslagen";
        header ("location:../detail.php?blogid=".$post_id."&userid=".$_SESSION['usr']['usr_id']);
        die;
    }
    header ("location:../inspireer.php");
    die;
    }


/*-------------------------------------Update Form------------------------------------------------------------------*/

            // extra controle of de ingelogde gebruiker geen post van iemand anders probeerd te wijzigen

if ($formname == "update_form" AND $_POST['submitpost'] == "update" AND $user_id == $_POST['post_usr_id']){

    // sql statement samenstellen met update gegevens

    $sql =  SqlPostUpdate($post_id,$post_blog,$post_cat,$post_land,$post_stad,$post_title);

    // als de blog niet upgedate kan worden zullen er error messages verschijnen in bij gehouden worden in de database

    if(ExecuteSQL($sql)){
        $_SESSION['message']= "Uw blog is aangepast";
        header ("location:../detail.php?blogid=".$post_id."&userid=".$_SESSION['usr']['usr_id']);
        die;
    }else{
        $_SESSION['error']= "Sorry, er is een probleem,er liep iets mis met het opslaan van uw blog";
        ErrorToDatabase($post_id,$_SESSION['error']);
        header ("location:../inspireer.php?postid=".$post_id);
        die;
    }

}else{
    $_SESSION['error']= "U was op een pagina waar u geen rechten toe heeft";

    // als er iemand probeerde om iemands anders blog te veranderen zal dit bijgehouden worden in de database

    ErrorToDatabase($post_id,$_SESSION['error']);
    header ("location:../index.php");
    die;
};

/*----------------------------------------------------------functies--------------------------------------------------------*/

function DeleteAllPostPicturesDirectory($postid){
    $sql = SqlPostImages($postid);
    $data = GetData($sql);
    foreach ( $data as $row )
    {
        foreach($row as $field => $value)
        {
            $value = "../".$value;
            if(!unlink($value)){

                // als de fotos niet van de server verwijderd kunnen worden zal er een error in de database ingevuld worden

                $error = " een foto van deze blog werd niet verwijdered";
                ErrorToDatabase($postid,$error);

            }
        }
}};

function DeletePostFromDatabase($postid){
    $sql = SqlPostDelete($postid);
    if(ExecuteSQL($sql)){
        return true;
     }else{
        return false;
    }
};
function CheckImages(){
    unset($_SESSION['error']);

    if($_FILES["filename"]["name"][0] == ""){
        $_SESSION['error']= "u moet minimum 1 foto toevoegen,";
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
            $_SESSION['error'] = " u mag enkel jpg, jpeg of png bestanden toevoegen";


        }
        if ($_FILES['filename']["size"][$i] > 6000000){
            $_SESSION['error'] = "een afbeelding mag maximum 6MB zijn";
        }
        if($_FILES["filename"]["name"][0] == ""){
            $_SESSION['error']= "u moet minimum 1 foto toevoegen,";
        }



    }
    if (isset($_SESSION['error'])){
        return false;
    }else{
        return true;
    }


}

function InsertDatabasePost($tablename){

    $blogtekst = $_POST['post_blog'];

        $date = new DateTime('NOW', new DateTimeZone('Europe/Brussels'));
        $date = $date->format('d-m-Y');
        $sql = SqlPostInsert($tablename,$blogtekst,$date);

        // Post in database opslaan

        if (!ExecuteSQL($sql)){
            $_SESSION['error']= "er liep iets mis met het opslaan van uw blog ";
            header ("location:../inspireer.php");
            die;

        }
}
function GetLatestPostid($user_id){
    $sql =  SqlPostGetPostid($user_id);
    $post_id = GetDataOneRow($sql );
    return $post_id['post_id'];
}

function InsertImagesInDirectory($post_id, $user_id){
    if(!is_dir("../images/user_".$user_id))mkdir("../images/user_".$user_id);
    $target_dir = "../images/user_".$user_id."/";

    // controleren hoeveel foto's er toegevoegd moeten worden

    $countfiles = count($_FILES["filename"]["name"]);

    $fotos = array();

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

        if(!move_uploaded_file($_FILES["filename"]["tmp_name"][$i],$target_file)){
            $_SESSION['error']= "Sorry, er is een probleem, uw blogtext is opgeslagen, maar een of meerdere van uw foto's niet";
            header ("location:../inspireer.php");
            die;
        };

    }
    return $fotos;

}

function InsertImagesDatabase($fotos, $post_id, $user_id){

    $countfiles = count($fotos);
    for($i=0;$i<$countfiles;$i++){
        $sql = "INSERT INTO afbeelding SET afb_post_id =". $post_id.",afb_filename='".$fotos[$i]."', afb_locatie= 'images/user_".$user_id."/".$fotos[$i]."'";
        ExecuteSQL($sql);

    }
}