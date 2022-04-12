<?php

session_start();

$server = "127.0.0.1";
$dbUser = "root";
$dbPassword = "";
$dbName = "group13";


$con =   mysqli_connect($server,$dbUser,$dbPassword,$dbName);

if(!$con){
    echo 'Error , '.mysqli_connect_error();
}