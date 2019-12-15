<?php
require_once 'lib/autoload.php';
require_once 'lib/ontdek_functies.php';
PrintPageSection('page_section_head');
PrintPageSection('page_section_main_nav');
?>


<main class="container" >
    <h1>Ontdek</h1>
    <?php
    PrintMessage();
    ?>

    <form action="lib/ontdek_functies.php" method="post" class="form" >
        <fieldset class="formcontainer dropdown-container">
            <?php


            print OntdekSearchbar()

            ?>


        </fieldset>
    </form>

    <section class="grid-ontdek">
    <?php
    $cat_id = $_GET['cat_id'];
    $land_id = $_GET['land_id'];
    if(!isset($land_id) and !isset($cat_id)){
        echo TegelOntdek($user_id);
    }
    elseif (isset($land_id) and !isset($cat_id)){
        echo TegelLandOntdek($land_id);
    }
    elseif (!isset($land_id) and isset($cat_id)){
        echo TegelCatOntdek($cat_id);
    }
    else {
        echo TegelLandCatOntdek($land_id, $cat_id, $user_id);
    }




    ?>

    </section>
</main>

<?php
PrintPageSection("page_section_footer");
?>