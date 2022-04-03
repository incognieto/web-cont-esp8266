<?php

    include "conn.php";
    
    $sql = mysqli_query($conn, "SELECT * FROM state");
    $data = mysqli_fetch_array($sql);
    $relay = $data['relay'];

    echo $relay;//give response for esp9266

?>