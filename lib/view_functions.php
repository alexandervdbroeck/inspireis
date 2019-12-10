<?php

/* afdrukken van niet dynamische delen van een pagina */
function PrintPageSection($template)
{
    print LoadTemplate("$template");
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

/*het formulier om een blog te creeren af drukken met eventuele error berichten*/
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
    /*vervangen van error berichten */
    $content = str_replace("@@message@@",$error,$content);
    unset($_SESSION["message"]);
    print $content;

}

function PrintUserLog($id){
    $sql = "SELECT usr_voornaam, usr_naam FROM user WHERE usr_id=".$id;
    $username = GetDataOneRow($sql);
    $sql = "SELECT log_in, log_out FROM logging WHERE log_usr_id=".$id;
    $userlogdata = GetData($sql);
    $temprow = LoadTemplate("user_log_row");
    $rows = ReplaceContent($userlogdata,$temprow);
    $templog = LoadTemplate("user_log");
    $temp = ReplaceContentOneRow($username, $templog);
    $content = str_replace("@@log_row@@", $rows, $temp);
    return $content;
}

