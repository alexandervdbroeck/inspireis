<?php
require_once "lib/autoload.php";
require_once "lib/volg.php";
PrintPageSection("head");
PrintPageSection("nav");
if(isset($_SESSION["message"])) print $_SESSION["message"];
unset($_SESSION["message"])
?>

<main class="container">
    <h1>Home</h1>
    <section class="grid">
        <?php

        /*Aanmaak variabele voor de functie TegelHome*/
        $user_id = $_SESSION['usr']['usr_id'];

        /*Print van de tegels*/
        echo TegelHome($user_id);

        ?>
    </section>
</main>
<?php
PrintPageSection("footer");
?>


