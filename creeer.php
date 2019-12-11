<?php
require_once "lib/autoload.php";
PrintPageSection("head");
PrintPageSection("nav");


?>
<main class="container ">

    <?php
    !isset($_GET['postid'])?   PrintcreateForm(): PrintUpdateForm($_GET['postid']);


    ?>
</main>

<?php
PrintPageSection("footer");
?>