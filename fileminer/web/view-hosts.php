<?php
    $servername = "localhost";
    $username = "fm";
    $password = "Password123!";
    $dbname = "file_miner";

    // create connection to MySQL
    $connection = new mysqli($servername, $username, $password, $dbname);

    // check connection
    if ($connection->connect_error) {
        die("connection failed: " . $connection->connect_error);
    }

    
    $sql = "SELECT id, ip FROM hosts;";
    $ip = ip2long("192.168.55.2");

    echo $ip . "<br/>";

    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"] . " - ip: " . $row["ip"] . "<br/>";

            if ($ip == $row["ip"]) {
                echo "exists!";
            }
        }
    }
    else {
        echo "0 results";
    }


    $connection->close();


?>