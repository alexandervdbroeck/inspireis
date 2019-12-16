<?php
require_once "autoload.php";

/* afdrukken van niet dynamische delen van een pagina */
function PrintPageSection($template)
{
    print LoadTemplate("$template");
}



/* Deze functie laadt de opgegeven template */
function LoadTemplate( $name )
{
//    $name = $submap."/".$name;
    if ( file_exists("$name.html") ) return file_get_contents("$name.html");
    if ( file_exists("template/$name.html") ) return file_get_contents("template/$name.html");
    if ( file_exists("../template/$name.html") ) return file_get_contents("../template/$name.html");
}

/* Deze functie voegt data en template samen en print het resultaat */
function ReplaceContent( $data, $template_html )
{
    $returnval = "";

    foreach ( $data as $row )
    {
        //replace fields with values in template
        $content = $template_html;
        foreach($row as $field => $value)
        {
            $content = str_replace("@@$field@@", $value, $content);
        }

        $returnval .= $content;
    }

    return $returnval;
}

function ReplaceContentSelect( $data, $template_html ,$id, $template_select)
{
    $returnval = "";

    foreach ( $data as $row )
    {
        //replace fields with values in template
        $content = $template_html;
        $content_select = $template_select;
        foreach($row as $field => $value)
        {
            if($value== $id ){

                $content = str_replace("@@$field@@", $value, $content_select);
            }else{

                $content = str_replace("@@$field@@", $value, $content);
            }

        }

        $returnval .= $content;
    }

    return $returnval;
}

/* Deze functie voegt data en template samen en print het resultaat */
function ReplaceContentOneRow( $row, $template_html )
{
    //replace fields with values in template
    $content = $template_html;
    foreach($row as $field => $value)
    {
        $content = str_replace("@@$field@@", $value, $content);
    }

    return $content;
}


/*een formulier printen met de bijhorende foutmeldingen*/
function PrintLoginOutForm($template_html)
{
    $content = LoadTemplate($template_html);
    $value = $_SESSION["message"];
    $content = str_replace("@@message@@", $value, $content);
    unset($_SESSION["message"]);

    print $content;

}

/*het formulier om een blog te creeren af drukken met eventuele error berichten*/
function PrintcreateForm()
{

    $landen = GetData("SELECT land_id, land_naam FROM landen");
    $templatelanden = LoadTemplate("form_select_landen");
    $optionlanden = ReplaceContent($landen,$templatelanden);
    $category = GetData("SELECT cat_id, cat_naam FROM category");
    $templatecategory = LoadTemplate("form_select_category");
    $optioncategory = ReplaceContent($category,$templatecategory);
    $content = LoadTemplate("inspireer_form");
    $content = str_replace("@@landen@@", $optionlanden, $content);
    $content = str_replace("@@category@@", $optioncategory, $content);


    print $content;
}

function PrintUpdateForm($postid){

    //Ophalen van de post info
    $sql = SqlInspireerUpdateSearch($postid);
    $data = GetDataOneRow($sql);

    // controle of de ingelogde user zijn eigen blog probeert te posten, ander wordt er een error aangemaakt en in de database gestoken

    if($data['post_user_id']== $_SESSION['usr']['usr_id']){

        // ophalen van opgeslagen landen en categorieen
        $landid = $data['post_land_id'];
        $catid = $data['post_cat_id'];

        // ophalen van de landen en categorieen om de drow down menus in te vullen

        $landen = GetData("SELECT land_id, land_naam FROM landen");

        $category = GetData("SELECT cat_id, cat_naam FROM category");
//        $data = GetDataOneRow($sql);

        // laden van select drop down menu's
        $templatelanden = LoadTemplate("form_select_landen");
        $templatecategory = LoadTemplate("form_select_category");
        $tempcatSelected = LoadTemplate('form_select_category_selected');
        $templandselected = LoadTemplate('form_select_landen_selected');

        // Content van de drop down menu's vervangen

        $optionlanden = ReplaceContentSelect($landen,$templatelanden,$landid,$templandselected);
        $optioncategory = ReplaceContentSelect($category,$templatecategory,$catid,$tempcatSelected);

        // laden van alle afbeeldingen
        $sql = SqlPostImages($postid);
        $afbeeldingen = GetData($sql);

        // laden en vervangen van de  selectie lijst van foto's om te verwijderen

        $afbtemplate = LoadTemplate('inspireer_update_delete_image_checkbox');
        $afbtemplate = ReplaceContent($afbeeldingen,$afbtemplate);

        // heel het form samen stellen met bovenstaande fromulieren van landen categorien en te deleten afbeeldingen

        $content = LoadTemplate("inspireer_update_form");
        $content = str_replace("@@landen@@", $optionlanden, $content);
        $content = str_replace("@@category@@", $optioncategory, $content);
        $content = str_replace("@@afb@@",$afbtemplate,$content);
        $content = ReplaceContentOneRow($data,$content);

        // afdrukken van het update formulier

        print $content;

        // als iemand toegang probeerd te krijgen tot het aanpassen van een post die niet van hem is wordt deze beweging
        // in de database opgeslagen (wie probeerde en wanneer)
    }else{ $_SESSION['error'] = "U probeerde toegang te krijgen tot een pagina waar uw geen machtiging toe hebt,
                                 Uw poging wordt gerigistreerd!";
        ErrorToDatabase($postid,$_SESSION['error']);
        PrintMessage();
        //header ("location: ../profiel.php");
       die;
    }




}


function PrintMessage(){
    if(isset($_SESSION['message'])){
        $message = "<p class=\"message container\">".$_SESSION['message']."</p>";
        print $message;
        unset($_SESSION["message"]);
    }
    if(isset($_SESSION['error'])){
        $message = "<p class=\"error container\">".$_SESSION['error']."</p>";
        print $message;
        unset($_SESSION["error"]);

    }

}
function PrintNavBar()
{
    //navbar items ophalen

    $data = GetData("select * from navigation order by nav_order ");

    // welke webpagina is actief
    // enkel laatse stuk van de url in(fileext)

    $active = $_SERVER['PHP_SELF'];
    $fileExplode = explode("/",$active);
    $filePath = end($fileExplode);
    $items_temp = LoadTemplate('page_section_nav_items');
    $active_template = LoadTemplate('page_section_nav_items_active');
    $fileExplode = explode("/",$active);
    $filePath = end($fileExplode);
    $replacetemp = "";

    // nav bar items samenstellen

    foreach ( $data as $row )
    {
        if($row['nav_path'] == $filePath){
            $replacetemp .= str_replace("@@nav_caption@@", $row['nav_caption'], $active_template);
            $replacetemp = str_replace("@@nav_path@@", $row['nav_path'], $replacetemp);
            }else{

            $replacetemp .= str_replace("@@nav_caption@@", $row['nav_caption'], $items_temp);
            $replacetemp = str_replace("@@nav_path@@", $row['nav_path'], $replacetemp);

        }


    }
    $temp = LoadTemplate('page_section_main_nav');
    print str_replace("@@navitems@@",$replacetemp,$temp);
}

