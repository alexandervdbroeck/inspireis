<?php

/*------------------------------formulieren en GET functies bevinden zich bovenaan ------------------------
 -------------------------------alle andere functies bevinden zich onderaan -------------------------------------*/

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
           $_SESSION['message'] = "Uw post werd verwijderd!";
           header ("location:".$_application_folder."profiel.php");
            die;
        }else{
            // als er iets mis loopt met het verwijderen , een message creeren
            $_SESSION['error'] = "Sorry er liep iets mis met het verwijderen van uw post";
            header ("location:".$_application_folder."profiel.php");

            // een error naar de databank versturen
            $error ="Een user probeerde zijn post te verwijderen maar dit lukte niet";
            ErrorToDatabase($postid,$error);
            die;
        }
        }
    $error ="verdachte poging om een post te verwijderen ";
    ErrorToDatabase($postid,$error);
    header ("location:".$_application_folder."profiel.php");
    die;

}


/*---------------------------inspireer create form-----------------------------------------------------*/


if ($formname == "creeer_form" AND $_POST['submitpost'] == "Save") {

    // controleren of er een foto is toegevoegd

    if(CheckImages()){

        // post tabel invullen
        InsertDatabasePost($tablename);

        // laatst ingegeven post_id ophalen
        $post_id = GetLatestPostid($user_id);

        // als er iets mis liep met het opvragen van een post id worden errors gecreeerd en in de DB opgsl.
        if(!isset($post_id)){
            $_SESSION['error']= "Er liep iets mis met het opslaan van uw blog!";
            ErrorToDatabase(0,"het post id kon niet opgevraagd worden");
            header ("location:".$_application_folder."inspireer.php");
            die;
        }
        // inserts fotos in de juiste directory (images/user_XX/plogid nrfoto.jpeg) en returns een lijst van de file names van de foto's
        $fotos = InsertImagesInDirectory($post_id,$user_id);

        // Fotos in de database opslaan
        InsertImagesDatabase($fotos,$post_id,$user_id);
        $_SESSION['message']= "Uw blog is opgeslagen!";
        header ("location:".$_application_folder."detail.php?blogid=".$post_id."&userid=".$_SESSION['usr']['usr_id']);
        die;
    }else{

        header ("location:".$_application_folder."inspireer.php");
        die;
    }

}

/*-------------------------------------Update Form------------------------------------------------------------------*/

            // extra controle of de ingelogde gebruiker geen post van iemand anders probeerd te wijzigen

if ($formname == "update_form" AND $_POST['submitpost'] == "update" ){

    if($user_id <> $_POST['post_usr_id']){
        $_SESSION['error']= "U was op een pagina waar u geen rechten toe heeft";
        // als er iemand probeerde om iemands anders blog te veranderen zal dit bijgehouden worden in de database
        ErrorToDatabase($post_id,$_SESSION['error']);
        header ("location:".$_application_folder."index.php");
        die;
    }

    // controle of er afbeeldingen zij die verwijderd moeten worden
    if($_POST['afb_filename'][0]<>""){
        DeleteImagesUpdate($post_id);

    }
    // controle of er afbeeldinge toegevoed moeten worden , en deze toevoegen
    if($_FILES["filename"]["name"][0] <> ""){
        if(CheckImages()){
            $fotos = InsertImagesInDirectory($post_id,$user_id);
            InsertImagesDatabase($fotos,$post_id,$user_id);
        }else{
            ErrorToDatabase($post_id,$_SESSION['error']);
            header ("location:".$_application_folder."inspireer.php?postid=".$post_id);
        }
    }

    // Statement samenstellen van het Sql statement om de post te verwijderen, en deze verwijderen
    $sql =  SqlPostUpdate($post_id,$post_blog,$post_cat,$post_land,$post_stad,$post_title);
    if(ExecuteSQL($sql)){
        $_SESSION['message']= "Uw blog is aangepast!";
        header ("location:".$_application_folder."detail.php?blogid=".$post_id."&userid=".$_SESSION['usr']['usr_id']);
        die;
    }else{
        $_SESSION['error']= "Sorry, er is een probleem! Er liep iets mis met het opslaan van uw blog.";
        ErrorToDatabase($post_id,$_SESSION['error']);
        header ("location:".$_application_folder."inspireer.php?postid=".$post_id);
        die;
    }
}

/*----------------------------------------------------------functies--------------------------------------------------------*/

function DeleteAllPostPicturesDirectory($postid){
    $sql = SqlPostImages($postid);
    $data = GetData($sql);
    foreach ( $data as $row )
    {
        foreach($row as $field => $value)
        {
            if($field == "afb_locatie"){
                $value = "../".$value;
                if(!unlink($value)){
                    // als de fotos niet van de server verwijderd kunnen worden zal er een error in de database ingevuld worden
                    $error = " een foto van deze blog werd niet verwijdered";
                    ErrorToDatabase($postid,$error);

                }
            }
        }
}}

function DeletePostFromDatabase($postid){
    $sql = SqlPostDelete($postid);
    if(ExecuteSQL($sql)){
        return true;
     }else{
        return false;
    }
}
function CheckImages(){
    // controle of er wel een foto is toegevoegd
    if($_FILES["filename"]["name"][0] == ""){
        $_SESSION['error']= "u moet minimum 1 foto toevoegen,";
        return false;
    }
    // check of foto een jpg, png of jpeg is en het extensie van de afbeelding
    $ext_allowed = array(
        "png",
        "jpg",
        "jpeg"
    );
    $countfiles = count($_FILES["filename"]["name"]);
    for($i=0;$i<$countfiles;$i++){

        // Alle afbeeldingen overlopen of deze het juiste fromaat hebben
        $filename = strtolower($_FILES["filename"]["name"][$i]) ;
        $fileExplode = explode(".",$filename);
        $fileExt = end($fileExplode);
        if (! in_array($fileExt,$ext_allowed)){
            $_SESSION['error'] = " u mag enkel jpg, jpeg of png bestanden toevoegen, ";
            return false;
        }
        if ($_FILES['filename']["size"][$i] > 8000000){
            $_SESSION['error'] .= "een afbeelding mag maximum 8MB zijn";
            return false;
        }
    }
    // als er geen errors zijn zal True meegeven worden
    return true;
}



function InsertDatabasePost($tablename){
global $_application_folder;
    $blogtekst = $_POST['post_blog'];
    $date = new DateTime('NOW', new DateTimeZone('Europe/Brussels'));

    $date = $date->format('d-m-Y');
    $sql = SqlPostInsert($tablename,$blogtekst,$date);

    // Post in database opslaan
    if (!ExecuteSQL($sql)){
        $_SESSION['error']= "er liep iets mis met het opslaan van uw blog ";
        header ("location:".$_application_folder."inspireer.php");
        die;
    }
}
function GetLatestPostid($user_id){
    $sql =  SqlPostGetPostid($user_id);
    $post_id = GetDataOneRow($sql );
    return $post_id['post_id'];
}

function InsertImagesInDirectory($post_id, $user_id){
    global $_application_folder;
    // controle of de user map in de imgages map reeds bestaat en anders aanmaken. (USR_XX)
    if(!is_dir("../images/user_".$user_id))mkdir("../images/user_".$user_id);
    $target_dir = "../images/user_".$user_id."/";

    // controleren hoeveel foto's er toegevoegd moeten worden
    $countfiles = count($_FILES["filename"]["name"]);
    // als er reeds foto's toegevoegd waren, tellen hoeveel.
    $fotonr = 0;
    $fotos = array();

    for($i=0;$i<$countfiles;$i++){

        // foto extensie ophalen in lowercase letters
        $filename = strtolower($_FILES["filename"]["name"][$i]) ;
        $fileExplode = explode(".",$filename);
        $fileExt = end($fileExplode);

        //fotonr creeren aan de hand van de $i
        $fotonr += 1;
        $_FILES["filename"]["name"][$i] = $post_id."_".$fotonr.".".$fileExt;
        $target_file = $target_dir.basename($_FILES["filename"]["name"][$i]);

        // als de fotonaam reeds bestaat de nr verhogen en bestandsnaam veranderen
        while(file_exists($target_file)) {
            $fotonr += 1;
            $_FILES["filename"]["name"][$i] = $post_id."_".$fotonr.".".$fileExt;
            $target_file = $target_dir.basename($_FILES["filename"]["name"][$i]);
        }
                /* deze functie werkt niet op de synta server omwille van instellingen in de php.ini*/
//      compressImage($_FILES["filename"]["tmp_name"][$i],$target_file,40);

        // het opslaan van de afbeeldingen (als dit niet lukt wordt er een foutmelding naar de database bijgehouden
       if(!move_uploaded_file($_FILES["filename"]["tmp_name"][$i],$target_file)){
           $_SESSION['error']= "Sorry, er is een probleem, uw blogtext is opgeslagen, maar een of meerdere van uw foto's niet";
           ErrorToDatabase($post_id,$_SESSION['error']);
           header ("location:../".$_application_folder."inspireer.php");
            die;
        };
//         filename  aan lijst toevoegen voor later gebruik(in database invoer)
        array_push($fotos,$_FILES["filename"]["name"][$i]);

    }
    return $fotos;
}

function InsertImagesDatabase($fotos, $post_id, $user_id){
    $countfiles = count($fotos);
    $sql = "";
    for($i=0;$i<$countfiles;$i++){
        $sql .= "INSERT INTO afbeelding SET afb_post_id =". $post_id.",afb_filename='".$fotos[$i]."', afb_locatie= 'images/user_".$user_id."/".$fotos[$i]."';";
    }
    ExecuteSQL($sql);
}

function DeleteImagesUpdate($postid){

    $data = $_POST['afb_filename'];
    foreach ( $data as $row => $value )
    {
        $sql = SqlSearchImage($value);
        $afb = GetDataOneRow($sql);
        $dir  = "../".$afb['afb_locatie'];
        if(!unlink($dir)){
            // als de fotos niet van de server verwijderd kunnen worden zal er een error in de database ingevuld worden
            $error = " een foto van deze blog werd niet verwijdered";
            ErrorToDatabase($postid,$error);
            die;
        }
        $sql = SqlDeleteImage($value);
        ExecuteSQL($sql);

} }





// Compress image werkt niet op de syntra server

function compressImage($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

}