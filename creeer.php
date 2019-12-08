<?php
require_once "lib/autoload.php";
PrintPageSection("head");
PrintPageSection("nav");


?>
<main class="container ">
    <?php
    PrintcreateForm();
    ?>
</main>

<?php
PrintPageSection("footer");
?>