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
                    ?>
                <a href="lib/tetsvolg.php?blog=<?php echo $_GET['blogid'];?>&userid=<?php echo $_GET['userid']?>" title=""><input type="submit" class="" name="Volg" value="Volg">
                    </a>
            </div>

        </div>
        <div><br></div>
        <div class="commentaar">
            <h2 class="title-blog">Reageer</h2>
            <input type="text"  name="commentaar" placeholder="Reageer"><br>
            <a href="" title=""><input type="submit" name="Reageer" value="Reageer"></a>
        </div>
    </div>
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
