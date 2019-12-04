<?php

require_once "autoload.php";

$formname = $_POST["formname"];
$tablename = $_POST["tablename"];
unset($_SESSION['message']);
// controlo of het juiste formulier aankomt
if ($formname == "creeer_form" AND $_POST['submitpost'] == "save_post") {
    var_dump($_POST);

    // sql statement samenstellen
    $sql = "INSERT INTO $tablename SET " .
        " post_title='" . htmlentities($_POST['post_title'], ENT_QUOTES) . "' , " .
        " post_blog='" . htmlentities($_POST['post_blog'], ENT_QUOTES) . "' , " .
        " post_stad_naam='" . htmlentities($_POST['post_stad_naam'], ENT_QUOTES) . "' , " .
        " post_user_id='" . $_SESSION['usr']['usr_id'] . "' , " .
        " post_cat_id='" . $_POST['cat_naam'] . "', ".
        " post_land_id='" . $_POST['land_id'] . "' ";
    // Post in database opslaan
  //  if (ExecuteSQL($sql)){
    //    $_SESSION['message']= "uw blog is gepost";
     //   $_SESSION['blogtext']= $_POST['post_blog'];
       // header ("location:../creeer.php");
//    }else {
  //      $_SESSION['message']= "er liep iets mis";
        var_dump($_SESSION);
       // header ("location:../creeer.php");
  //  }

}
