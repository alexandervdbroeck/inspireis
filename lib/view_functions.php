<?php


/* afdrukken van niet dynamische delen van een pagina */
function PrintPageSection($template)
{
    print LoadTemplate("$template");
}

function PrintNavBar()
{
    //navbar items ophalen
    $data = GetData("select * from menu order by men_order");

    $laatste_deel_url = basename($_SERVER['SCRIPT_NAME']);

    //aan de juiste datarij, de sleutels 'active' en 'sr-only' toevoegen
    foreach( $data as $r => $row )
    {
        if ( $laatste_deel_url == $data[$r]['men_destination'] )
        {
            $data[$r]['active'] = 'active';
            $data[$r]['sr_only'] = '<span class="sr-only">(current)</span>';
        }
        else
        {
            $data[$r]['active'] = '';
            $data[$r]['sr_only'] = '';
        }
    }

    //template voor 1 item samenvoegen met data voor items
    $template_navbar_item = LoadTemplate("navbar_item");
    $navbar_items = ReplaceContent($data, $template_navbar_item);

    //navbar template samenvoegen met resultaat ($navbar_items)
    $data = array( "navbar_items" => $navbar_items ) ;
    $template_navbar = LoadTemplate("navbar");
    print ReplaceContentOneRow($data, $template_navbar);
}

/* Deze functie laadt de opgegeven template */
function LoadTemplate( $name )
{
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
function PrintForm($template_html)
{
    $content = LoadTemplate($template_html);
    $value = $_SESSION["message"];
    $content = str_replace("@@message@@", $value, $content);
    unset($_SESSION["message"]);

    print $content;

}

/*het formulier om een blog te creeren af drukkne*/
function PrintcreateForm()
{
    //samenstellen van de <option> menu landen
    $error = $_SESSION['message'];
    $landen = GetData("SELECT land_id, land_naam FROM landen");
    $templatelanden = LoadTemplate("select_landen");
    $optionlanden = ReplaceContent($landen,$templatelanden);
    $category = GetData("SELECT cat_id, cat_naam FROM category");
    $templatecategory = LoadTemplate("select_category");
    $optioncategory = ReplaceContent($category,$templatecategory);
    $content = LoadTemplate("creeerform");
    $content = str_replace("@@landen@@", $optionlanden, $content);
    $content = str_replace("@@category@@", $optioncategory, $content);
    $content = str_replace("@@message@@",$error,$content);


    print $content;

}