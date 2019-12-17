<?php
session_start();
$formname = $_POST["formname"];
if ($formname == "ontdek_form" && $_POST['search'] == "zoek") {
    if (!isset($_POST['land_id']) && !isset($_POST['cat_id'])) {
        $_SESSION["error"] = "u heeft niets geselecteerd";
        header("location:../".$_application_folder."ontdek.php");
        die;
    } elseif (isset($_POST['land_id']) && !isset($_POST['cat_id'])) {
        header("location:../".$_application_folder."ontdek.php?land_id=" . $_POST['land_id']);
        die;
    } elseif (!isset($_POST['land_id']) && isset($_POST['cat_id'])) {
        header("location:../".$_application_folder."ontdek.php?cat_id=" . $_POST['cat_id']);
        die;
    } else {
        header("location:../".$_application_folder."ontdek.php?land_id=" . $_POST['land_id'] . "&cat_id=" . $_POST['cat_id']);
        die;
    }
}