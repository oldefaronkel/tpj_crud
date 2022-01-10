<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "tpj_crud";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}
