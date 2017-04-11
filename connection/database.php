<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "contest";

try {
    $connection_string = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $connection_string->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage(); exit;
}

//$connection_string = null;
?>