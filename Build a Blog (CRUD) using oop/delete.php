<?php

require 'dbConnection.php';
require 'helpers/Validation.php';
$dbConnection = new dbConnection(SERVER,DB_USER,DB_PASS,DB_NAME);
$con = $dbConnection->getCon();


    $id = $_GET['id'];
    if(Validation::validate($id,'int')){

        $op = $dbConnection->doQuery("select image from blog where id = $id");
        $imgPath = $dbConnection->fetchRows($op)[0];
        $rowsAffected = $dbConnection->doQuery("delete from blog where id = $id");
        if ($rowsAffected) {

            $_SESSION['Message'] = 'Blog Removed';
            unlink($imgPath);
        }
    }
    else {
        $_SESSION['Message'] = 'invalid ID';
    }



    header("location: index.php");



?>