<?php
require_once "autoload.php";
function TegelHome($user_id,$offset) {
    $sql = SqlTegelHome($user_id,$offset);
    $data = GetData($sql);
    $temp = LoadTemplate("index_polaroid");
    $temp = ReplaceContent($data, $temp);
    return $temp; }