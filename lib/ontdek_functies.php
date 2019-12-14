

<?php
require_once "autoload.php";

//Print tegels op ontdekpagina afhankelijk van de zoekresultaten van de zoekbar
/*Print tegels zonder ingave in zoekresultaat*/
function TegelOntdek()
{
    $sql = SqlTegelOntdek();
    $data = GetData($sql);
    $temp = LoadTemplate("ontdek_polaroid");
    $temp = ReplaceContent($data, $temp);
    return $temp;
}

/*Print tegels met ingave van het land*/
function TegelLandOntdek ($id_land){
    $sql = SqlSearchLandIngevuld($id_land);
    $data = GetData($sql);
    $temp = LoadTemplate("ontdek_polaroid");
    $temp = ReplaceContent($data, $temp);
    return $temp;
}

/*Print tegels met ingave van de categorie*/
function TegelCatOntdek($cat_id){
    $sql = SqlSearchCatIngevuld($cat_id);
    $data = GetData($sql);
    $temp = LoadTemplate("ontdek_polaroid");
    $temp = ReplaceContent($data, $temp);
    return $temp;
}

/*Print tegels met ingave van zowel land als categorie*/
function TegelLandCatOntdek($id_land, $cat_id){
    $sql = SqlSearchLandCatIngevuld($id_land, $cat_id);
    $data = GetData($sql);
    $temp = LoadTemplate("ontdek_polaroid");
    $temp= ReplaceContent($data, $temp);
    return $temp;
}
function OntdekSearchbar(){

    $sql = SQLSearchCatOntdek();
    $data = GetData($sql);
    $temp = LoadTemplate('form_select_category');
    $category = ReplaceContent($data,$temp);
    $sql = SqlSearchLandOntdek();
    $data = GetData($sql);
    $temp = LoadTemplate('form_select_landen');
    $landen = ReplaceContent($data,$temp);
    $temp = LoadTemplate('ontdek_search_form');
    $temp = str_replace("@@land_naam@@", $landen, $temp);
    $temp = str_replace("@@cat_naam@@", $category, $temp);

    return $temp;
}



    $formname = $_POST["formname"];
    if ($formname == "ontdek_form" && $_POST['search'] == "zoek") {
        if (!isset($_POST['land_id']) && !isset($_POST['cat_id'])) {
            $_SESSION["message"] = "u heeft niets geselecteerd";
            header("location:../ontdek.php");
        } elseif (isset($_POST['land_id']) && !isset($_POST['cat_id'])) {
            header("location:../ontdek.php?land_id=" . $_POST['land_id']);
        } elseif (!isset($_POST['land_id']) && isset($_POST['cat_id'])) {
            header("location:../ontdek.php?cat_id=" . $_POST['cat_id']);
        } else {
            header("location:../ontdek.php?land_id=" . $_POST['land_id'] . "&cat_id=" . $_POST['cat_id']);
        }
    }



?>