<?php

include 'dbConnection.php';
include "helpers/Validation.php";

$dbConnection = new dbConnection(SERVER,DB_USER,DB_PASS,DB_NAME);
$data = $dbConnection->doQuery("select * from blog");
$con = $dbConnection->getCon();
?>



<!DOCTYPE html>
<html>

<head>
    <title>PDO - Read Records - PHP CRUD Tutorial</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }
    </style>

</head>

<body>


<div class="container">


    <div class="page-header">
        <h1>Read Blogs </h1>
        <br>

        <?php


        if(isset($_SESSION['Message']))
        {

            if(is_array($_SESSION['Message'])){
                foreach($_SESSION['Message'] as $key => $value){
                    echo '* ' . $key . ' ' . $value;
                }
            }
            else {
                echo $_SESSION['Message'];
            }


            unset($_SESSION['Message']);

        }


        ?>


    </div>

    <a href="create.php">+ Blog</a>
<!--    --><?php
/*        if(isset($_SESSION['succ']))
        {
            echo '<div class="alert alert-success" role="alert">';
            echo $_SESSION['succ'];
            echo '</div>';
            unset($_SESSION['succ']);
        }
    */?>

    <table class='table table-hover table-responsive table-bordered'>
        <!-- creating our table heading -->
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>

            <th>action</th>
        </tr>

        <?php

        while($raw = mysqli_fetch_assoc($data))
        {
            ?>
                <tr>
                    <td><?php echo $raw['id'];?></td>
                    <td><?php echo $raw['title'];?></td>
                    <td><?php echo $raw['content'];?></td>
                    <td>
                        <img src="<?php echo $raw['image'];?>" class="img-fluid " width="50px" height="50px" alt="">
                    </td>

                    <td>
                        <a href='delete.php?id=<?php echo $raw['id'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                        <a href='edit.php?id=<?php echo $raw['id'];?>' class='btn btn-primary m-r-1em'>Edit</a>
                    </td>
            </tr>

        <?php } ?>
    </table>

</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>