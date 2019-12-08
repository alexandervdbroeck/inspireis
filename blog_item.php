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
                /* als de user nog niet gevold wordt print de volg knop*/
                if($row['follow'] == 0){
                    $blogid = $_GET['blogid'];
                    $userid = $_GET['userid'];
                    $temp =LoadTemplate("blog-bericht-follow");
                    $temp = str_replace("@@blog_id@@", $blogid, $temp);
                    $temp = str_replace("@@user_id@@", $userid, $temp);
                    echo $temp;

                }else {
                  /*als de user reeds gevolgd wordt print de ontvolg knop*/
                    $blogid = $_GET['blogid'];
                    $userid = $_GET['userid'];
                    $temp =LoadTemplate("blog-bericht-unfollow");
                    $temp = str_replace("@@blog_id@@", $blogid, $temp);
                    $temp = str_replace("@@user_id@@", $userid, $temp);
                    echo $temp;
                }
                    ?>

<?php
        /* printen van het commentaar formulier*/
        $temp = LoadTemplate("blog-bericht-comment");
        $temp = str_replace("@@usr_id@@",$_GET['userid'],$temp);
        $temp = str_replace("@@post_id@@",$_GET['blogid'],$temp);
        echo $temp;
        /* Printen van de commentaren van deze blog moet nog gelayout worden*/
       /* $temp = LoadTemplate('blog-bericht-comment-overview');
        $sql = SqlCommentSearch($_GET['blogid']);
        $data= GetData($sql);
        print ReplaceContent($data,$temp);*/


        /* Printen van het blog verhaal met 1 foto*/
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
