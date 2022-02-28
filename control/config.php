<?php
    //dsn=>"data search name".
    $dsn="mysql:host=localhost;dbname=Shop";
    $user="root";
    $password="";
    $option=array(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    try
    {
        $con = new PDO($dsn,$user,$password,$option);
    } 
    catch (PDOException $e) 
    {
        echo $e->getMessage();
        exit;
    }

?>