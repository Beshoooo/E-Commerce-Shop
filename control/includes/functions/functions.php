<?php

    //title function that set the page title dynamic.
    function setTitle()
    {
        global $page_title;
        if(isset($page_title))
        {
            echo $page_title;
        }
        else
        {
            echo "Default";
        }
    }

?>