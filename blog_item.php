<?php
require_once "lib/autoload.php";
PrintPageSection("head");
PrintPageSection("nav");
if(isset($_SESSION["message"])) print '<p class=error>'. $_SESSION["message"]."</p>";
unset($_SESSION["message"]);
?>
<main class="container blogbericht">
    <div class="profiel-commentaar">
        <div class="profiel-blogbericht">
            <div>
                <h2 class="title-blog">Alexander Van den Broeck</h2>
            </div>
            <div class="profiel-detail">
                <p class="details">3 posts</p>
                <p class="details">65 volgers</p>
                <p class="details">36 volgend</p>
                <a href="lib/tetsvolg.php?blog=<?php echo $_GET['blogid'];?>" title=""><input type="submit" class="" name="Volg" value="Volg">
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
