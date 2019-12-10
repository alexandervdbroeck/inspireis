<?php

require_once "autoload.php";
var_dump($_POST);
if ($formname == "ontdek_form" AND $_POST['search'] == "zoek") {
    if(!isset($_POST['land_id']) and !isset($_POST['land_id'])){
        header ("location:../ontdek.php");
    }else {
        header ("location:../ontdek.php?land_id=".$_POST['land_id']."&cat_id=".$_POST['cat_id']);
    }
};
