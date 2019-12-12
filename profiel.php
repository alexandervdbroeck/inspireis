<?php
require_once "lib/autoload.php";
PrintPageSection("head");
PrintPageSection("nav");
?>


<main>
    <?php
    PrintError();
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
<!
        </div>
        </div>
        <div class="container grid-profile" >
            <?php
            if(!isset($_GET['userid'])){
                $sql = SqlBlogItemsProfile($_SESSION['usr']['usr_id']);
                $data = GetData($sql);
                $temp = LoadTemplate('profiel-tegel');
                echo ReplaceContent($data,$temp);
            }else {
                $sql = SqlBlogItemsProfile($_GET['userid']);
                $data = GetData($sql);
                $temp = LoadTemplate('profiel-tegel-getuser');
                echo ReplaceContent($data,$temp);

            }
//            $sql = SqlBlogItemsProfile($_SESSION['usr']['usr_id']);


            ?>




        </div>
    </div>
</main>
<?php
PrintPageSection("footer");
?>


