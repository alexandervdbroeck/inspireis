<?php
require_once "lib/autoload.php";
PrintPageSection("head");
PrintPageSection("nav");
if(isset($_SESSION["message"])) print $_SESSION["message"];
unset($_SESSION["message"])
?>

<main class="container tegelcontainer" id="displaytegels">
    <div class="tegel"><img src="images/1.JPG" alt="afbeelding">
        <p class="datum">27-11-2019</p>
        <h2>Dag 3: Spanje</h2>
        <a href="#" title="#" class="userlink">Alexander Van den Broeck</a>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi architecto nisi facere dignissimos officiis dicta et sunt molestiae ducimus.</p>
        <a href="../blog/blog-item.html" title="">Lees meer</a>
    </div>
    <div class="tegel"><img src="images/2.JPG" alt="afbeelding">
        <p class="datum">26-11-2019</p>
        <h2>Dag 3: Tenerife</h2>
        <a href="#" title="#" class="userlink">Maya Vekemans</a>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est reiciendis reprehenderit vitae ea eos quod suscipit sapiente. </p><a href="#" title="">Lees meer</a>
    </div>
    <div class="tegel"><img src="images/3.JPG" alt="afbeelding">
        <p class="datum">25-11-2019</p>
        <h2>Dag 2: Spanje</h2>
        <a href="#" title="#" class="userlink">Alexander Van den Broeck</a>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p><a href="#" title="">Lees meer</a>

    </div>
    <div class="tegel"><img src="images/4.JPG" alt="afbeelding">
        <p class="datum">24-11-2019</p>
        <h2>Dag 2: Tenerife</h2>
        <a href="#" title="#" class="userlink">Maya Vekemans</a>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident commodi dolorem saepe, nisi quasi laborum, consequuntur harum. </p>
        <a href="#" title="">Lees meer</a>

    </div>
    <div class="tegel"><img src="images/5.JPG" alt="afbeelding">
        <p class="datum">23-11-2019</p>
        <h2>Dag 1: Spanje</h2>
        <a href="#" title="#" class="userlink">Alexander Van den Broeck</a>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis voluptatem beatae deserunt aspernatur vel repudiandae.</p>
        <a href="#" title="">Lees meer</a>
    </div>
    <div class="tegel"><img src="images/6.JPG" alt="afbeelding">
        <p class="datum">22-11-2019</p>
        <h2>Dag 1: Tenerife</h2>
        <a href="#" title="#" class="userlink">Maya Vekemans</a>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit asperiores aspernatur tenetur esse!</p>
        <a href="#" title="">Lees meer</a>
    </div>

</main>
