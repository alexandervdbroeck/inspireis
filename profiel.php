<?php
require_once "lib/autoload.php";
include_once "lib/detail_functions.php";
PrintPageSection("page_section_head");
PrintPageSection("page_section_main_nav");
?>


<main>
    <?php
    PrintMessage();
    ?>
    <h1>Profiel</h1>
    <div class="container container-profiel">
        <div class="profiel ">

            <?php
            if(isset($_GET['userid'])){
                $user = "get";
                $usrid = $_GET['userid'];
                echo GetFollowers($usrid);

            }else{
                $user = "session";
                $usrid = $_SESSION['usr']['usr_id'];
                echo GetFollowers($usrid);

            }

            ?>

        </div>
        <div class="container grid-profile" >
            <?php

            // controleren of het de ingelogde gebruiker is die zijn profiel bekijkt er een profiel van een ander gebruiker wordt opgezicht
            if(!isset($_GET['userid'])){
                $sql = SqlProfielPolaroid($_SESSION['usr']['usr_id']);
                $data = GetData($sql);
                $temp = LoadTemplate('profiel_polaroid');
                echo ReplaceContent($data,$temp);
            }else {
                $sql = SqlProfielPolaroid($_GET['userid']);
                $data = GetData($sql);
                // laden van het polaroid template zonder de verwijder en aanpas functies
                $temp = LoadTemplate('profiel_polaroid_no_change_functions');
                echo ReplaceContent($data,$temp);

            }

            ?>




        </div>
    </div>
</main>
<?php
PrintPageSection("page_section_footer");
?>


