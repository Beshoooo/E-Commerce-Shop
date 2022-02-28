
<?php
    include "config.php";

    $tpl="includes/templates/"; //templates directory
    $lang="includes/languages/";//language directory
    $func="includes/functions/";//functions directory
    $layout="layout/css/"; //layout directory
    $js="layout/js/";//js directory
    
    //include the important files
    include $func. "functions.php";
    include $lang. "en.php";
    include $tpl . "header.php";
    
    if(!isset($noNav))
    {
        include $tpl . "navbar.php";  
    }
    
?>