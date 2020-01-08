<?php
require_once "lib/autoload.php";
include_once "lib/index_functions.php";
            /*printen van de pagina hoofding*/
PrintPageSection("page_section_head");
PrintNavBar();


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
        $offset = (!isset($_GET['offset'])) ? 0:$_GET['offset'];
        if($offset < 0)$offset=0;
        echo indexPolaroid($offset,9);
        $urlplus = $_SERVER['PHP_SELF']."?offset=".($offset + 9);
        $urlmin = $_SERVER['PHP_SELF']."?offset=".($offset - 9);
        echo "<a href='$urlmin'>vorige</a><a href='$urlplus'>volgende</a>";
        ?>
    </section>
</main>
<?php
PrintPageSection("page_section_footer");
?>


