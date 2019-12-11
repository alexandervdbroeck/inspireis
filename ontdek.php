<?php
include_once 'lib/autoload.php';
PrintPageSection('head');
PrintPageSection('nav');
?>


<main class="container" >
    <h1>Ontdek</h1>
    <form action="lib/ontdekform.php" method="post" class="form" >
        <fieldset class="formcontainer dropdown-container">
            <?php

            function SearchCatOntdek(){

                $sql = SQLSearchCatOntdek();
                $data = GetData($sql);
                $temp = LoadTemplate('select_category');
                $category = ReplaceContent($data,$temp);
                $sql = SqlSearchLandOntdek();
                $data = GetData($sql);
                $temp = LoadTemplate('select_landen');
                $landen = ReplaceContent($data,$temp);
                $temp = LoadTemplate('zoekbar_ontdek');
                $temp = str_replace("@@land_naam@@", $landen, $temp);
                $temp = str_replace("@@cat_naam@@", $category, $temp);
//                $temp = ReplaceContentOneRow($data, $temp);
                return $temp;
            }

            print SearchCatOntdek()

            ?>


        </fieldset>
    </form>

    <section class="grid-ontdek">
    <?php
    $cat_id = $_GET['cat_id'];
    $land_id = $_GET['land_id'];
    var_dump($cat_id);
    var_dump($land_id);
    if(!isset($land_id) and !isset($cat_id)){
        echo TegelOntdek($user_id);
//    }elseif ($land_id == ""){
//        echo "land";
//    } else {
//        echo "beide";
    }

    /*Printen van de tegels op de Ontdek pagina*/


    ?>

    </section>
</main>

<?php
PrintPageSection("footer");
?>