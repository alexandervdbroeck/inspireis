<?php

require_once "autoload.php";

/*------------------------------formulier in ontdek_from----------------------------------------------*/


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

function OntdekLandSearch($id_land)
{
    $sql = SqlOntdekSearchLand($id_land);
    $data = GetData($sql);
    $temp = LoadTemplate("ontdek_polaroid");
    $temp = ReplaceContent($data, $temp);
    return $temp;
}

/*Print tegels met ingave van de categorie*/

function OntdekCatSearch($cat_id)
{
    $sql = SqlOntdekSearchCat($cat_id);
    $data = GetData($sql);

    $temp = LoadTemplate("ontdek_polaroid");
    $temp = ReplaceContent($data, $temp);
    return $temp;
}

/*Print tegels met ingave van zowel land als categorie*/

function ontdekSearchAll($id_land, $cat_id)
{
    $sql = SqlOntdekSearchLandCat($id_land, $cat_id);
    $data = GetData($sql);
    $temp = LoadTemplate("ontdek_polaroid");
    $temp = ReplaceContent($data, $temp);
    return $temp;
}

function OntdekSearchbar()
{

    $sql = SQLSearchCatOntdek();
    $data = GetData($sql);
    $temp = LoadTemplate('form_select_category');
    $category = ReplaceContent($data, $temp);
    $sql = SqlSearchLandOntdek();
    $data = GetData($sql);
    $temp = LoadTemplate('form_select_landen');
    $landen = ReplaceContent($data, $temp);
    $temp = LoadTemplate('ontdek_search_form');
    $temp = str_replace("@@land_naam@@", $landen, $temp);
    $temp = str_replace("@@cat_naam@@", $category, $temp);

    return $temp;
}
