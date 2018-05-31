<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "urban_dictionary";

$conn_create = new mysqli($dbServername, $dbUsername, '') or die("Unable to connect");
$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName) or die("Unable to connect");
