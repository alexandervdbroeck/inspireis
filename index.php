<?php
require_once "lib/autoload.php";
require_once "lib/volg.php";
PrintPageSection("head");
PrintPageSection("nav");
if(isset($_SESSION["message"])) print $_SESSION["message"];
unset($_SESSION["message"])
?>
<main class="container">
    <h1>Home</h1>
    <section class="grid">
        <div class="tegel">
            <a href="#" title=""><img src="images/1.JPG" alt="afbeelding"></a>
            <p class="datum">27-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 3: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/2.JPG" alt="afbeelding"></a>
            <p class="datum">26-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 3: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/3.JPG" alt="afbeelding"></a>
            <p class="datum">25-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 2: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/4.JPG" alt="afbeelding"></a>
            <p class="datum">24-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 2: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/5.JPG" alt="afbeelding"></a>
            <p class="datum">23-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 1: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>

        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/6.JPG" alt="afbeelding"></a>
            <p class="datum">22-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 1: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>       <div class="tegel">
            <a href="#" title=""><img src="images/1.JPG" alt="afbeelding"></a>
            <p class="datum">27-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 3: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/2.JPG" alt="afbeelding"></a>
            <p class="datum">26-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 3: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/3.JPG" alt="afbeelding"></a>
            <p class="datum">25-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 2: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/4.JPG" alt="afbeelding"></a>
            <p class="datum">24-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 2: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/5.JPG" alt="afbeelding"></a>
            <p class="datum">23-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 1: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>

        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/6.JPG" alt="afbeelding"></a>
            <p class="datum">22-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 1: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div><div class="tegel">
            <a href="#" title=""><img src="images/1.JPG" alt="afbeelding"></a>
            <p class="datum">27-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 3: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/2.JPG" alt="afbeelding"></a>
            <p class="datum">26-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 3: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/3.JPG" alt="afbeelding"></a>
            <p class="datum">25-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 2: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/4.JPG" alt="afbeelding"></a>
            <p class="datum">24-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 2: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/5.JPG" alt="afbeelding"></a>
            <p class="datum">23-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 1: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>

        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/6.JPG" alt="afbeelding"></a>
            <p class="datum">22-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 1: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>       <div class="tegel">
            <a href="#" title=""><img src="images/1.JPG" alt="afbeelding"></a>
            <p class="datum">27-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 3: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/2.JPG" alt="afbeelding"></a>
            <p class="datum">26-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 3: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/3.JPG" alt="afbeelding"></a>
            <p class="datum">25-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 2: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/4.JPG" alt="afbeelding"></a>
            <p class="datum">24-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 2: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/5.JPG" alt="afbeelding"></a>
            <p class="datum">23-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 1: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>

        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/6.JPG" alt="afbeelding"></a>
            <p class="datum">22-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 1: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/1.JPG" alt="afbeelding"></a>
            <p class="datum">27-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 3: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/2.JPG" alt="afbeelding"></a>
            <p class="datum">26-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 3: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/3.JPG" alt="afbeelding"></a>
            <p class="datum">25-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 2: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/4.JPG" alt="afbeelding"></a>
            <p class="datum">24-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 2: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/5.JPG" alt="afbeelding"></a>
            <p class="datum">23-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 1: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>

        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/6.JPG" alt="afbeelding"></a>
            <p class="datum">22-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 1: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>       <div class="tegel">
            <a href="#" title=""><img src="images/1.JPG" alt="afbeelding"></a>
            <p class="datum">27-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 3: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/2.JPG" alt="afbeelding"></a>
            <p class="datum">26-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 3: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/3.JPG" alt="afbeelding"></a>
            <p class="datum">25-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 2: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/4.JPG" alt="afbeelding"></a>
            <p class="datum">24-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 2: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/5.JPG" alt="afbeelding"></a>
            <p class="datum">23-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 1: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>

        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/6.JPG" alt="afbeelding"></a>
            <p class="datum">22-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 1: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div><div class="tegel">
            <a href="#" title=""><img src="images/1.JPG" alt="afbeelding"></a>
            <p class="datum">27-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 3: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/2.JPG" alt="afbeelding"></a>
            <p class="datum">26-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 3: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/3.JPG" alt="afbeelding"></a>
            <p class="datum">25-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 2: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/4.JPG" alt="afbeelding"></a>
            <p class="datum">24-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 2: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/5.JPG" alt="afbeelding"></a>
            <p class="datum">23-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 1: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>

        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/6.JPG" alt="afbeelding"></a>
            <p class="datum">22-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 1: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>       <div class="tegel">
            <a href="#" title=""><img src="images/1.JPG" alt="afbeelding"></a>
            <p class="datum">27-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 3: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/2.JPG" alt="afbeelding"></a>
            <p class="datum">26-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 3: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/3.JPG" alt="afbeelding"></a>
            <p class="datum">25-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 2: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/4.JPG" alt="afbeelding"></a>
            <p class="datum">24-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 2: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/5.JPG" alt="afbeelding"></a>
            <p class="datum">23-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 1: Spanje</h2></a>
            <a href="#" title="" class="userlink">Alexander Van den Broeck</a>

        </div>
        <div class="tegel">
            <a href="#" title=""><img src="images/6.JPG" alt="afbeelding"></a>
            <p class="datum">22-11-2019</p>
            <a href="#" title=""><h2 class="title-blog">Dag 1: Tenerife</h2></a>
            <a href="#" title="" class="userlink">Maya Vekemans</a>
        </div>
    </section>
</main>
<?php
PrintPageSection("footer");
?>


