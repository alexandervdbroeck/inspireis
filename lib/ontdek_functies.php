<?php
function TegelOntdek($user_id)
{
    $sql = SqlTegelOntdek($user_id);
    $data = GetData($sql);
    $temp = LoadTemplate("tegel_ontdek");
    $temp = ReplaceContent($data, $temp);
    return $temp;
}


?>