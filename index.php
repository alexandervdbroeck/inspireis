<?php
require_once "lib/autoload.php";
include_once "lib/index_functions.php";
            /*printen van de pagina hoofding*/
PrintPageSection("page_section_head");

PrintPageSection("page_section_main_nav");

?>

<main class="container">

    <?php
        /* als  er berichten zijn deze printen, als er errors zijn worden deze rood gekleurd*/
    PrintMessage();

    ?>
    <h1>Home</h1>
    <section class="grid">
        <?php
        /* Printen van de polaroids, parameters zijn aantal getoonde foto's (maxpolaroid) en de offset*/
        /*Bedoeling is dat hier later een next button komt*/
        /*de users die door de ingelogde gebruiker gevolgd worden worden opgezocht */
        echo indexPolaroid(0,18);

        ?>
    </section>
</main>
<?php
PrintPageSection("page_section_footer");
?>


