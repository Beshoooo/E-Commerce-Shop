<?php

function lang($phrase)
{
    static $language=array
    (
        //Navbar links
        "HOME_ADMIN"    =>"Home",
        "CATEGORIES"    =>"Sections",
        "ITEMS"         =>"Items",
        "MEMBERS"       =>"Members",
        "STATISTICS"    =>"Statistics",
        "LOGS"          =>"Logs",
        ""=>"",
        ""=>"",
        ""=>"",
        ""=>"",
        ""=>""
    );

    return $language[$phrase];
}

?>