<?php

    session_start();
    session_unset();   //un set data in the session
    session_destroy(); //destroy the session

    header("location:index.php");
    exit();

?>