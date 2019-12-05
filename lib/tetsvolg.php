<?php
//Insert Data
require_once "autoload.php";


$sql = "INSERT INTO volgers SET volg_user_id=".$_SESSION['usr']['usr_id'].",
        volg_volgt_user_id=".$_POST["usr_id"];
        ExecuteSQL($sql);
        var_dump($sql);





?>