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
        $temp = LoadTemplate('zoekbar_ontdek');
        print $temp;


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