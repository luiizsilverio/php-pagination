<?php

$host = "localhost";
$db = "curso_php";
$user = "root";
$pass = "root";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_errno) {
  die("Falha na conexão! " . $conn->connect_error);
} 

?>
