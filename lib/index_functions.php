<?php
require_once "autoload.php";

function indexPolaroid( $offset, $maxpolaroid) {

    /*de users die door de ingelogde gebruiker gevolgd worden worden opgezocht */

    $user_id = $_SESSION['usr']['usr_id'];
    $sql = SqlIndexPolaroid($user_id,$offset, $maxpolaroid);

    $data = GetData($sql);
    $temp = LoadTemplate("index_polaroid");
    $temp = ReplaceContent($data, $temp);
    return $temp; }