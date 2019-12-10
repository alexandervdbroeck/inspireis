<?php
require_once "lib/autoload.php";
PrintPageSection("head");
PrintPageSection("nav");
if(isset($_SESSION["message"])) print $_SESSION["message"];
unset($_SESSION["message"])
?>


<main>
    <h1>Profiel</h1>
    <div class="container container-profiel">
        <div class="profiel ">

            <?php
            echo GetFollowers();

            ?>
<!
        </div>
        </div>
        <div class="container grid-profile" >
            <?php
            $sql = SqlBlogItemsProfile($_SESSION['usr']['usr_id']);
            $data = GetData($sql);
            $temp = LoadTemplate('profiel-tegel');
            echo ReplaceContent($data,$temp);

            ?>




        </div>
    </div>
</main>
<?php
PrintPageSection("footer");
?>


