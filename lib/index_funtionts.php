<?php
require_once "autoload.php";
function TegelHome($user_id,$offset) {
    $sql = SqlTegelHome($user_id,$offset);
    $data = GetData($sql);
    $temp = LoadTemplate("tegel_home");
    $temp = ReplaceContent($data, $temp);
    return $temp; }