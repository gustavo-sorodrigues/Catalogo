<?php

$servername = "localhost";
$database = "catalogo_entretenimento";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Conexão falhou:" . mysqli_connect_error());
}
