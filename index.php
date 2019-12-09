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
        <?php

        function TegelHome($user_id)
        {
            $sql = SqlTegelHome($user_id);
            $data = GetData($sql);
            $temp = LoadTemplate("tegel_home");
            $temp = ReplaceContent($data, $temp);
            return $temp;
        }

        echo TegelHome($user_id);

        ?>
    </section>
</main>
<?php
PrintPageSection("footer");
?>


