<?php
include_once 'lib/autoload.php';
PrintPageSection('head');
PrintPageSection('nav');
?>


<main class="container" >
    <h1>Ontdek</h1>
    <form action="" class="form">
        <fieldset class="formcontainer dropdown-container">
            <?php

            function SearchCatOntdek(){

                $sql = SQLSearchCatOntdek();
                $data = GetData($sql);

                $temp = LoadTemplate('zoekbar_ontdek');
                $temp = ReplaceContentOneRow($data, $temp);
                return $temp;
            }

            print SearchCatOntdek()

            ?>


        </fieldset>
    </form>

    <section class="grid-ontdek">
    <?php

    /*Aanmaak variabele voor de functie TegelOntdek*/
    $user_id = $_SESSION['usr']['usr_id'];

    /*Printen van de tegels op de Ontdek pagina*/
    echo TegelOntdek($user_id);

    ?>

    </section>
</main>

<?php
PrintPageSection("footer");
?>