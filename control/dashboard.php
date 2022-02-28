<?php
    session_start();

    if(isset($_SESSION["Username"]))
    {
        $page_title="Dashboard";
        include "init.php";
        include $tpl ."footer.php";
        //session_destroy(); // to remove all previous data
    }
    else
    {
        echo "you are not athorized to be here .";
        header("Location: index.php");
        exit();
    }

?>
