<?php
function TegelHome($user_id) {
    $sql = SqlTegelHome($user_id);
    $data = GetData($sql);
    $temp = LoadTemplate("tegel_home");
    $temp = ReplaceContent($data, $temp);
    return $temp;
}
?>

