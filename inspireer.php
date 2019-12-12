<?php
require_once "lib/autoload.php";
PrintPageSection("head");
PrintPageSection("nav");


?>
<main class="container ">

    <?php
    PrintError();

    !isset($_GET['postid'])?   PrintcreateForm(): PrintUpdateForm($_GET['postid']);
    var_dump($_SESSION);
    ?>
</main>

<?php
PrintPageSection("footer");
?>