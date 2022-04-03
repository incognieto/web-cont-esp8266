<?php
    include "conn.php";

    $num = $_GET['num'];
    
    mysqli_query($conn, "UPDATE state SET lampu='$num'");

    echo $num;
    
?>