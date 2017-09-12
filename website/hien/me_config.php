<?php

    $conn=pg_connect("host=localhost port=5432 dbname=btl user=postgres password=11021996");
    if(!$conn){
        echo"error connect"; exit();
    }
?>