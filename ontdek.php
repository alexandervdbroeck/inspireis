<?php
require_once 'lib/autoload.php';
include_once 'lib/ontdek_functions.php';
PrintPageSection('page_section_head');
PrintNavBar();
PrintMessage();
print OntdekSearchbar();

// binnen halen of er een zoekfunctie gegenereerd is
$cat_id = $_GET['cat_id'];
$land_id = $_GET['land_id'];

// afhankelijk van welke zoekfunctie gekozen is:

if(!isset($land_id) and !isset($cat_id)){
    // alle post afdrukken
    echo OntekPolaroid($user_id);
}
elseif (isset($land_id) and !isset($cat_id)){
    // de post van de gekozen landen drukken
    echo OntdekLandSearch($land_id);
}
elseif (!isset($land_id) and isset($cat_id)){
    // de post van de gekozen categorien tonen
    echo OntdekCatSearch($cat_id);
}
else {
    // de post waar zowel categorien als land gezocht moet worden.
    echo ontdekSearchAll($land_id, $cat_id, $user_id);
}

?>

    </section>
</main>

<?php
PrintPageSection("page_section_footer");
?>