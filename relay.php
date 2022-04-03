<?php
    include "conn.php";

    $stat = $_GET['stat'];
    if($stat == "ON"){
        mysqli_query($conn, "UPDATE state SET relay=1");
        echo "ON";
    }
    else{
        mysqli_query($conn, "UPDATE state SET relay=0");
        echo "OFF";
    }
?>