<?php
require_once "lib/autoload.php";
include_once "lib/detail_functions.php";
PrintPageSection("page_section_head");
PrintNavBar();
?>


<main>
    <?php
    PrintMessage();
    ?>
    <h1>Profiel</h1>
    <div class="container container-profiel">
        <div class="profiel ">

            <?php
            // afdrukken van de user status (hoeveel post en volgers) afvankelijk of men de eigen profielpagina opend of die van iemand anders

            if(isset($_GET['userid'])){
                $user = "get";
                $usrid = $_GET['userid'];
                echo ProfielUserStatus($usrid);

            }else{
                $user = "session";
                $usrid = $_SESSION['usr']['usr_id'];
                echo ProfielUserStatus($usrid);

            }

            ?>

        </div>
        <div class="container grid-profile" >
            <?php
            /*-------------als de user zijn eigen profiel pagina bekijkt zijn er meer mogelijkheiden, namelijk het aanpassen
            en verwijderen van post's dit wordt hieronder gecontroleerd of men men zijn eigen profiel pagina bekijkt of die van iemand
            anders ook een controle of men niet probeerd een andermans post te bewerken*/

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


