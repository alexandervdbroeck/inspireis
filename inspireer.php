<?php
require_once "lib/autoload.php";
PrintPageSection("page_section_head");
PrintPageSection("page_section_main_nav");


?>
<main class="container ">

    <?php
    PrintMessage();

    !isset($_GET['postid'])?   PrintcreateForm(): PrintUpdateForm($_GET['postid']);
    var_dump($_SESSION);
    ?>
</main>

<?php
PrintPageSection("page_section_footer");
?>