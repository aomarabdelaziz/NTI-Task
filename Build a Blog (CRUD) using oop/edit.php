<?php

include 'dbConnection.php';
include "helpers/Validation.php";

$id = $_GET['id'];
if(Validation::validate($id,'int'))
{
    $dbConnection = new dbConnection(SERVER,DB_USER,DB_PASS,DB_NAME);
    $op = $dbConnection->doQuery("select * from blog where id = $id");
    $data = $dbConnection->fetchAssocRows($op);
    $con = $dbConnection->getCon();

}
else {
    $_SESSION['Message'] = 'invalid ID';
    header('Location: index.php');
}



if($_SERVER['REQUEST_METHOD'] == "POST"){



    $title = Validation::clean($_POST['title']);
    $content = Validation::clean( $_POST['content']);
    $errors = [];


    if(!Validation::validate($title , 'required')){
        $errors['Title'] = "Field Required";
    }elseif(!Validation::validate($title , 'string')){
        $errors['Title'] = "Field must be a string";
    }

    if(!Validation::validate($content , 'required')){
        $errors['Content'] = "Field Required";
    }elseif(!Validation::validate($content , 'min' , 50)){
        $errors['Content'] = "Field Length must be >= 50 chars";
    }

    $importImage = false;
    if(!empty($_FILES['image']['type']))
    {
        if (!Validation::validate($_FILES, 'image')) {
            $errors['Image'] = "Invalid Format";
        }
        else{
            $importImage = true;
        }

    }


    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    }
    else {

        $disPath = $data['image'];
        echo $disPath . '<br>';

        if($importImage) {
            $op = $dbConnection->doQuery("select image from blog where id = $id");
            $imgPath = $dbConnection->fetchRows($op)[0];

            unlink($imgPath);
            echo $imgPath . '<br>';
            $typesInfo  =  explode('/', $_FILES['image']['type']);   // convert string to array ...
            $extension  =  strtolower(end($typesInfo));      // get last element in array ....

            # Create Final Name ...
            $FinalName = uniqid() . '.' . $extension;

            $disPath = 'uploads/' . $FinalName;

            $temPath = $_FILES['image']['tmp_name'];

            move_uploaded_file($temPath , $disPath);

        }




        $op = $dbConnection->doQuery("update blog set title = '$title' , content = '$content' , image = '$disPath' where id = $id");

        if ($op) {
            $message = ["success" => "Raw Updated"];
        } else {
            $message = ["Error" => "Try Again"];
        }
        $_SESSION['Message'] = $message;

    }

    header("location: index.php");

}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>


<div class="container">

    <div class="row">
        <div class="col-12">

            <?php
            if(isset($_SESSION['error']))
            {
                if(is_array($_SESSION['error']))
                {
                    echo '<div class="alert alert-danger" role="alert">';
                    foreach($_SESSION as $key => $value) {
                        foreach($value as $index => $content){

                            echo '* '.$index.' : '.$content.'<br>';

                        }
                    }
                    echo '</div>';
                }
                else
                {
                    echo $_SESSION['error'];
                }
                unset($_SESSION['error']);
            }
            ?>

            <form action="<?php echo   htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $data['id']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Title:</label>
                    <input type="text" value="<?php echo $data['title'] ?>" name="title" class="form-control" id="" aria-describedby="" placeholder="Enter title">
                </div>
                <div class="form-group">
                    <label for="">Content</label>
                    <input type="text" name="content" value="<?php echo $data['content'] ?>" class="form-control" id="" placeholder="content">
                </div>

                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file"  class="form-control" name="image">
                </div>
                <div class="form-group">
                    <label for="">Image Preview</label>
                    <img class="img-fluid"  width="50px" height="50px" src="<?php echo $data['image'] ?>" alt="">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>