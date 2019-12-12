<?php

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

function PrintUpdateForm($postid)
{
    //samenstellen van de <option> menu landen
    $error = $_SESSION['message'];
    $landen = GetData("SELECT land_id, land_naam FROM landen");
    $templatelanden = LoadTemplate("select_landen");
    $category = GetData("SELECT cat_id, cat_naam FROM category");
    $sql = SqlBlogUpdateSearch($postid);
    $data = GetDataOneRow($sql);
    if(!$data['post_user_id']== $_SESSION['usr']['usr_id']){
        $_SESSION['message'] = "U hebt een pagina bezocht waar u niet gemachtigd toe was,.. foefelaar";
        header ("location:profiel.php");
        die;
    }
    $landid = $data['post_land_id'];
    $catid = $data['post_cat_id'];
    $templatecategory = LoadTemplate("select_category");
    $tempcatSelected = LoadTemplate('select_category_selected');
    $templandselected = LoadTemplate('select_landen_selected');
    $optionlanden = ReplaceContentSelect($landen,$templatelanden,$landid,$templandselected);
    $optioncategory = ReplaceContentSelect($category,$templatecategory,$catid,$tempcatSelected);
    $content = LoadTemplate("update-form");
    $content = str_replace("@@landen@@", $optionlanden, $content);
    $content = str_replace("@@category@@", $optioncategory, $content);
    /*vervangen van error berichten */
    $content = str_replace("@@message@@",$error,$content);
    $content = ReplaceContentOneRow($data,$content);


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

function PrintError(){
    $message = "<p class=\"error\">".$_SESSION['message']."</p>";
    print $message;
    unset($_SESSION["message"]);
}

function TegelHome($user_id,$offset) {
    $sql = SqlTegelHome($user_id,$offset);
    $data = GetData($sql);
    $temp = LoadTemplate("tegel_home");
    $temp = ReplaceContent($data, $temp);
    return $temp; }

function TegelOntdek()
{
    $sql = SqlTegelOntdek();
    $data = GetData($sql);
    $temp = LoadTemplate("tegel_ontdek");
    $temp = ReplaceContent($data, $temp);
    return $temp;
}

/*Print tegels met ingave van het land*/
function TegelLandOntdek ($id_land){
    $sql = SqlSearchLandIngevuld($id_land);
    $data = GetData($sql);
    $temp = LoadTemplate("tegel_ontdek");
    $temp = ReplaceContent($data, $temp);
    return $temp;
}

/*Print tegels met ingave van de categorie*/
function TegelCatOntdek($cat_id){
    $sql = SqlSearchCatIngevuld($cat_id);
    $data = GetData($sql);
    $temp = LoadTemplate("tegel_ontdek");
    $temp = ReplaceContent($data, $temp);
    return $temp;
}

/*Print tegels met ingave van zowel land als categorie*/
function TegelLandCatOntdek($id_land, $cat_id){
    $sql = SqlSearchLandCatIngevuld($id_land, $cat_id);
    $data = GetData($sql);
    $temp = LoadTemplate("tegel_ontdek");
    $temp= ReplaceContent($data, $temp);
    return $temp;
}