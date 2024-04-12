<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "dev_edu_center";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",$db_username, $db_password);
    $message = "Bazaga ulandi!";
} catch(PDOException $e){
    echo "Bazaga ulana olmadi: " . $e->getMessage();
    //$errors = $e->getMessage();
}




