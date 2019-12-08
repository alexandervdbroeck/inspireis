<?php
require_once "lib/autoload.php";

PrintPageSection("head");
PrintPageSection("nav");
if(isset($_SESSION["message"])) print '<p class=error>'. $_SESSION["message"]."</p>";
unset($_SESSION["message"]);
?>
<main class="container blogbericht">
    <div class="profiel-commentaar">

                <?php
                /* afdrukken van de naam van de blogger, het aantal post's hoeveel volgers en hoeveel bloggers hij volgt*/
                /*samensellen aantal volgers*/
                    $sql = SqlBlogItemsSearchVolgers($_GET['userid']);
                    $row = GetDataOneRow($sql);
                    $temp = LoadTemplate("blog-bericht-volgers");
                    $temp = ReplaceContentOneRow($row,$temp);
                    /*samenstellen hoeveel post's en naam vd blogger*/
                    $sql = SqlBlogItemsCountPost($_GET['userid']);
                    $row = GetDataOneRow($sql);
                    $temp = ReplaceContentOneRow($row,$temp);
                    echo $temp;
                $sql = SqlBlogItemsCheckFollow($_SESSION['usr']['usr_id'],$_GET['userid']);
                $row = GetDataOneRow($sql);
                /*Check of de de ingelogde user de bekeken user al volgt,*/
                if($row['follow'] == 0){
                    $blogid = $_GET['blogid'];
                    $userid = $_GET['userid'];
                    $temp =LoadTemplate("blog-bericht-follow");
                    $temp = str_replace("@@blog_id@@", $blogid, $temp);
                    $temp = str_replace("@@user_id@@", $userid, $temp);
                    echo $temp;

                }else {

                    $blogid = $_GET['blogid'];
                    $userid = $_GET['userid'];
                    $temp =LoadTemplate("blog-bericht-unfollow");
                    $temp = str_replace("@@blog_id@@", $blogid, $temp);
                    $temp = str_replace("@@user_id@@", $userid, $temp);
                    echo $temp;
                }
                    ?>


<?php
                $temp = LoadTemplate("blog-bericht-comment");
                echo $temp;

?>

    <?php
    $blogid = $_GET['blogid'];
    $sql = SqlBlogItems($blogid);
    $row = GetDataOneRow($sql);
    $temp = LoadTemplate("blog-bericht");
    $blogdetail = ReplaceContentOneRow($row,$temp);
    echo $blogdetail;
    ?>
</main>

<?php
PrintPageSection("footer");
?>
