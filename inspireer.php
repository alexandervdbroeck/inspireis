<?php
require_once "lib/autoload.php";
PrintPageSection("page_section_head");
PrintNavBar();


?>
<main class="container ">

    <?php
    PrintMessage();

    !isset($_GET['postid'])?   PrintcreateForm(): PrintUpdateForm($_GET['postid']);

    ?>
</main>

<?php
PrintPageSection("page_section_footer");
?>