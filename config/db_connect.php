<?php
    $servername = "mysql-service.beatrixkiddo-database.svc.cluster.local";
    $username = "admin";
    $password = "I0Sw5Zxd";
    $dbname = "beatrixkiddo";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully";
?>