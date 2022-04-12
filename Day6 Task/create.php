<?php

include 'dbConnection.php';
include "helpers/functions.php";




if($_SERVER['REQUEST_METHOD'] == "POST"){


    $title = clean($_POST['title']);
    $content = clean( $_POST['content']);
    $date = clean( $_POST['date']);
    $errors = [];

    ///[Name Validation]
    if(empty($title)){
        $errors['title'] = 'Title Required';
    }
    if(is_numeric($title)){
        $errors['name'] = 'Name must be string';
    }
    ///End [Name Validation]

    ///[Email Validation]
    if(empty($content)){
        $errors['email'] = 'Content Required';
    }
    if(strlen($content) < 1){
        $errors['email'] = 'Content must be at least 50 character';
    }
    ///End [Email Validation]

    $FinalName = '';

    if (!empty($_FILES['image']['name']))
    {
        $name    = $_FILES['image']['name'];
        $temPath = $_FILES['image']['tmp_name'];
        $size    = $_FILES['image']['size'];
        $type    = $_FILES['image']['type'];
        $typesInfo  =  explode('/', $type);   // convert string to array ...
        $extension  =  strtolower( end($typesInfo));      // get last element in array ....

        $allowedExtension = ['png', 'jpg' , 'jpeg'];   // allowed Extension    // PDF

        $disPath = '';
        if (in_array($extension, $allowedExtension)) {

            $FinalName = time() . rand() . '.' . $extension;
            $disPath = 'uploads/' . $FinalName;

            if (!move_uploaded_file($temPath, $disPath)) {

                $errors['image'] = "Error occurred while uploading the image";
            }
        }
        else {
            $errors['image'] = "[png,jpg,jpeg] extensions is only allowed";
        }
    }
    else {
        $errors['image'] = "Image is required";
    }

    if(!empty($date)){

        $newDate = explode('-',$date);

        if(checkdate($newDate[1], $newDate[2], $newDate[0]))
        {

            $currentDate = date('Y-m-d');
            $date=date("Y-m-d",strtotime($date));

            if($date != $currentDate){
                $errors['date'] = "Date must be equal the current date";

            }


        }




    }
    else {
        $errors['date'] = "Date is required";
    }


    if(count($errors) > 0) {

        $_SESSION['error'] = $errors;
    }
    else {

        $sql = "insert into blog (title,content,img_path,date) values ('$title','$content','$disPath','$date')";

        $rowsAffected = mysqli_query($con,$sql);
        if($rowsAffected) {
            $_SESSION['succ'] = 'Blog Module Created Successfully';


        }
        else {
            $_SESSION['error'] = 'Erro occured while inserting data';

        }



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

          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
              <div class="form-group">
                  <label for="">Title:</label>
                  <input type="text" name="title" class="form-control" id="" aria-describedby="" placeholder="Enter title">
              </div>
              <div class="form-group">
                  <label for="">Content</label>
                  <input type="text" name="content" class="form-control" id="" placeholder="content">
              </div>
              <div class="form-group">
                  <label for="">Image</label>
                  <input type="file"  class="form-control" name="image">
              </div>
              <div class="form-group">
                  <label for="">Current Date</label>
                  <input type="text" name="date" class="form-control" id="" placeholder="date">

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