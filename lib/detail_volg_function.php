<?php

require_once "autoload.php";

/*------------------------------via de get functie wordt het volgen of het ontvolgen van een ander user-------------
--------------------------------hier verwerkt  om iemand te volgen wordt userid(usr_id)meegegven en om te weten-----------
--------------------------------of iemand niet meer gevold dient te worden wordt ook unfollow=yes- meegegeven------------*/

if (isset($_GET['userid'])and !isset($_GET['unfollow'])){
    //check welke gebruiker gevolgd dient te worden
    $blog_id= $_GET['blog'];
    $followuser= $_GET['userid'];
    $userid = $_SESSION['usr']['usr_id'];
    /* invoeren in de database*/
    $sql = SQLDetailAddFollow($followuser,$userid);
    ExecuteSQL($sql);
    /* terug naar de juiste detail pagina*/
    header ("location:".$_application_folder."detail.php?blogid=".$blog_id."&userid=".$followuser);
}
// iemand niet meer volgen
if(isset($_GET['unfollow'])){
    $blog_id= $_GET['blog'];
    $followuser= $_GET['userid'];
    $userid = $_SESSION['usr']['usr_id'];
    /* invoeren in de database*/
    $sql = SQLDetailUnFollow($followuser,$userid);
    ExecuteSQL($sql);
    /* terug naar de juiste detail pagina*/
    header ("location:".$_application_folder."detail.php?blogid=".$blog_id."&userid=".$followuser);
}



