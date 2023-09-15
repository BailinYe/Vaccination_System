<?php
$servername = "bec353.encs.concordia.ca";
$username = "bec353_1";
$password = "Best353C";
$dbname = "bec353_1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>