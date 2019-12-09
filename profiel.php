<?php
require_once "lib/autoload.php";
require_once "lib/volg.php";
PrintPageSection("head");
PrintPageSection("nav");
if(isset($_SESSION["message"])) print $_SESSION["message"];
unset($_SESSION["message"])
?>


<main>
    <h1>Profiel</h1>
    <div class="container container-profiel">
        <div class="profiel ">
            <div>
                <h2 class="title-blog">Alana Lievens</h2>
            </div>
            <div class="profiel-detail">
                <p class="details">6 posts</p>
                <p class="details">36 volgers</p>
                <p class="details">18 volgend</p>
                <a href="" title=""><p class="instellingen">Instellingen</p></a>
            </div>

        </div>
        <div class="container grid-profile" >
            <div class="tegel-profile">
                <a href="" title=""><img src="../images/londoneye.jpg" alt="afbeelding"></a>
                <a href="blog_item.php?blogid=97&userid=15" title=""><h2 class="title-blog">Toertje in London Eye</h2></a>
                <a href="" title=""><p class="wijzigen">Wijzigen</p></a>
            </div>
            <div class="tegel-profile">
                <a href="" title=""><img src="../images/paddington.png" alt="afbeelding"></a>
                <a href="blog_item.php?blogid=96&userid=17" title=""><h2 class="title-blog">Paddington bezoeken</h2></a>
                <a href="" title=""><p class="wijzigen">Wijzigen</p></a>
            </div>


        </div>
    </div>
</main>
<?php
PrintPageSection("footer");
?>


