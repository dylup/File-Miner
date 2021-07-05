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

    $ip = $_REQUEST['ip'];

    echo $names;

    $check = ip2long($ip);

    $exists = FALSE;
    
    // check to see if our host is in the database
    $sql = "SELECT id, ip FROM hosts;";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($check == $row["ip"]) {
                $exists = TRUE;
            }
        }
    }
    else {
        echo "";
    }

    // if the host is not in the database, add it
    if ($exists == FALSE) {
        $sql = "INSERT INTO hosts (ip) VALUES (INET_ATON('$ip'))";
        if ($connection->query($sql) === TRUE) {
            echo "new record created!";
        }
        else {
            echo "Error: " . $sql . " " . $sql->error;
        }
    }
    else {
        echo "already exists!";
    }

    $connection->close();


?>