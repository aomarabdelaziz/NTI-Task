<?php

require 'dbConnection.php';

    $id = $_GET['id'];
    if(filter_var($id,FILTER_VALIDATE_INT))
    {
        $sql = "select img_path from blog where id = $id";
        $op = mysqli_query($con, $sql);
        $imgPath = mysqli_fetch_row($op)[0];

        $sql = "delete from blog where id = $id";
        $rowsAffected = mysqli_query($con, $sql);
        if ($rowsAffected) {

            $_SESSION['succ'] = 'Raw Removed';
            unlink($imgPath);
        }

    }
    else {
        $_SESSION['error'] = 'invalid ID';
    }


    header("location: index.php");



?>