<?php
$login_acces = true;
require_once "lib/autoload.php";

PrintPageSection("head");
PrintPageSection("nav_login");
PrintForm("login_form");
PrintPageSection("footer");
?>
