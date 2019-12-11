

<?php
////require_once "autoload.php";
////Print tegels op ontdekpagina afhankelijk van de zoekresultaten van de zoekbar
///*Print tegels zonder ingave in zoekresultaat*/
//function TegelOntdek()
//{
//    $sql = SqlTegelOntdek();
//    $data = GetData($sql);
//    $temp = LoadTemplate("tegel_ontdek");
//    $temp = ReplaceContent($data, $temp);
//    return $temp;
//}
//
///*Print tegels met ingave van het land*/
//function TegelLandOntdek ($id_land){
//    $sql = SqlSearchLandIngevuld($id_land);
//    $data = GetData($sql);
//    $temp = LoadTemplate("tegel_ontdek");
//    $temp = ReplaceContent($data, $temp);
//    return $temp;
//}
//
///*Print tegels met ingave van de categorie*/
//function TegelCatOntdek($cat_id){
//    $sql = SqlSearchCatIngevuld($cat_id);
//    $data = GetData($sql);
//    $temp = LoadTemplate("tegel_ontdek");
//    $temp = ReplaceContent($data, $temp);
//    return $temp;
//}
//
///*Print tegels met ingave van zowel land als categorie*/
//function TegelLandCatOntdek($id_land, $cat_id){
//    $sql = SqlSearchLandCatIngevuld($id_land, $cat_id);
//    $data = GetData($sql);
//    $temp = LoadTemplate("tegel_ontdek");
//    $temp= ReplaceContent($data, $temp);
//    return $temp;
//}
//
//?>