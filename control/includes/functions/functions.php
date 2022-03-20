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

    /*
    ** RedirectPage v2.0
    ** redirectPage function [take parameters]
    ** $erorrMsg = echo the error message 
    ** $url      = redirect page
    ** $second   = time before redirect
    ** $msg      = check if there is an message or no
    */
    function redirectPage($erorrMsg,$url="index.php",$second=3,$msg=true)
    {
        if($msg==true)
        {
            echo "<div class='alert alert-danger'>".$erorrMsg."</div>";
            echo "<div class='alert alert-info'>You will be redirect to home page after ".$second." second.</div>";
            header("refresh:$second;url=".$url);
            exit;
        }
        else
        {
            echo "<div class='alert alert-info'>You will be redirect after ".$second." second.</div>";
            header("refresh:$second;url=".$url);
            exit;
        }

    }

    /*
    ** checkItems v1.0
    ** checkItems function [take parameters]
    ** $item  = the item that we want to check [column name]
    ** $table = from any table ?
    ** $value = the value enterd that you want to chexk
    */
    function checkItems($item="*",$table,$value)
    {   
        global $con;
        $stmtget=$con->prepare("select $item from $table where $item= ? limit 1");
        $stmtget->execute(array($value));
        $count=$stmtget->rowCount();
        return $count;
    }



?>


