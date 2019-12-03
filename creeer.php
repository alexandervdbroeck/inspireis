<?php
require_once "lib/autoload.php";
PrintPageSection("head");
PrintPageSection("nav");
if(isset($_SESSION["message"])) print $_SESSION["message"];
unset($_SESSION["message"])
?>
<main class="container ">
    <?php
    PrintcreateForm();
    ?>
</main>

<?php
PrintPageSection("footer");
?>