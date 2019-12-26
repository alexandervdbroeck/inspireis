<?php

require_once "lib/autoload.php";
include_once "lib/detail_functions.php";

PrintPageSection("page_section_head");
PrintNavBar();
PrintMessage();
?>
<main class="container blogbericht">
    <div class="profiel-commentaar">
        <?php
            // variablen aanmaken (get)
            $userid  = $_GET['userid'];
            $blogid = $_GET['blogid'];

            // controle of er een post en user id via get meegegeven is, anders redirecten naar de index pagina
            if(!isset($userid) and !isset($blogid)){
                $_SESSION["error"] = "Sorry, er liep iets mis bij het laden van een blog!";
                PrintMessage();
                die;
            }
            // printen van de user status (hoeveel posts en hoeveel volgers) met bijhorende volg knop

            echo DetailUserStatusAndFollowButton($userid,$blogid);
            // formulier om commentaar bij te voegen en de reeds geschreven comenteren printen
            echo CommentForm($userid,$blogid);
            // de effective post met foto's  en bijhoorende info afdrukken
            echo BlogTekst($blogid);

        ?>

</main>

<?php
PrintPageSection("page_section_footer");
?>
