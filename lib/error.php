<?php
include_once "autoload.php";

/*-----------------------------als er verdachte bewegingen opgemerkt worden of als een user een probleem ondervindt
-------------------------------met het opslaan, bewerken of verwijderen van zijn blogs wordt dit in de database---
-------------------------------bijgehouden (datum, omscrhijving en eventueel over welke post het gaat------------*/

function ErrorToDatabase($postid,$error){
    $sql = SqlError($postid,$error);
    ExecuteSQL($sql);

}
