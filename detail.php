<?php
require_once "lib/autoload.php";
include_once "lib/detail_functions.php";

PrintPageSection("page_section_head");
PrintPageSection("page_section_main_nav");
if(isset($_SESSION["message"])) print '<p class=error>'. $_SESSION["message"]."</p>";
//unset($_SESSION["message"]);
?>
<main class="container blogbericht">
    <div class="profiel-commentaar">
        <?php
            /*aanmaken van de user en blog id*/
            $userid  = $_GET['userid'];
            $blogid = $_GET['blogid'];

            /* als er geen userid of blogid meegegeven een error bericht generen en naar de indexpagina sturen*/
            if(!isset($userid) and !isset($blogid)){
                $_SESSION["message"] = "Sorry er liep iets mis bij het laden van een blog";
                header("Location: index.php");
            }

            /*printen van het detailformulier met de volgknopfucntie*/
            echo GetFollowersAndFollowButton($userid,$blogid);

            /*commentaar formulier afdrukken*/
            echo CommentForm($userid,$blogid);

            /* afdrukken van de blogtekst met bijhorende foto's*/
            echo BlogTekst($blogid);

            /*  afdrukken van alle geposte commentaren*/
//           echo Commentaren($blogid);

        ?>

</main>

<?php
PrintPageSection("page_section_footer");
?>
