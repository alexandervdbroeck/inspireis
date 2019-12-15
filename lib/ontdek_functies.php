

<?php
require_once "autoload.php";

/*------------------------------formulier bovenaan functies onderaan de pagina-------------------------------------*/

$formname = $_POST["formname"];
if ($formname == "ontdek_form" && $_POST['search'] == "zoek") {
    if (!isset($_POST['land_id']) && !isset($_POST['cat_id'])) {
        $_SESSION["error"] = "u heeft niets geselecteerd";
        header("location:../ontdek.php");
    } elseif (isset($_POST['land_id']) && !isset($_POST['cat_id'])) {
        header("location:../ontdek.php?land_id=" . $_POST['land_id']);
    } elseif (!isset($_POST['land_id']) && isset($_POST['cat_id'])) {
        header("location:../ontdek.php?cat_id=" . $_POST['cat_id']);
    } else {
        header("location:../ontdek.php?land_id=" . $_POST['land_id'] . "&cat_id=" . $_POST['cat_id']);
    }
}



/*-------------------------------functies--------------------------------------------------------------------------*/
function OntekPolaroid()
{
    $sql = SqlOntdekNoSearch();
    $data = GetData($sql);
    $temp = LoadTemplate("ontdek_polaroid");
    $temp = ReplaceContent($data, $temp);
    return $temp;
}

/*Print tegels met ingave van het land*/

function OntdekLandSearch ($id_land){
    $sql = SqlOntdekSearchLand($id_land);
    $data = GetData($sql);
    $temp = LoadTemplate("ontdek_polaroid");
    $temp = ReplaceContent($data, $temp);
    return $temp;
}

/*Print tegels met ingave van de categorie*/

function OntdekCatSearch($cat_id){
    $sql = SqlOntdekSearchCat($cat_id);
    $data = GetData($sql);

    $temp = LoadTemplate("ontdek_polaroid");
    $temp = ReplaceContent($data, $temp);
    return $temp;
}

/*Print tegels met ingave van zowel land als categorie*/

function ontdekSearchAll($id_land, $cat_id){
    $sql = SqlOntdekSearchLandCat($id_land, $cat_id);
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







?>