<?php
require_once "lib/autoload.php";
include_once "lib/index_funtionts.php";
PrintPageSection("page_section_head");
PrintPageSection("page_section_main_nav");

?>

<main class="container">
    <?php
    PrintError();

    ?>
    <h1>Home</h1>
    <section class="grid">
        <?php

        /*Aanmaak variabele voor de functie TegelHome*/
        $user_id = $_SESSION['usr']['usr_id'];
        /*Print van de tegels*/

        echo TegelHome($user_id,0);

        ?>
    </section>
</main>
<?php
PrintPageSection("page_section_footer");
?>


