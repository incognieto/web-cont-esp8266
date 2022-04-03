<?php

    include "conn.php";
    
    $sql = mysqli_query($conn, "SELECT * FROM state");
    $data = mysqli_fetch_array($sql);
    $lampu = $data['lampu'];

    echo $lampu;//give response for esp8266

?>