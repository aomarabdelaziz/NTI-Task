<?php




if($_SERVER['REQUEST_METHOD'] == "POST"){


    $title = $_POST['title'];
    $content = $_POST['content'];
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
      if(strlen($content) < 50){
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


    if(count($errors) > 0) {

        foreach($errors as $key => $value){
            echo '* '.$key.' : '.$value.'<br>';
        }
    }
    else {



        /*    if(file_exists('data/content.json')){
                $currentData = file_get_contents('data/content.json');
                $array_data = json_decode($currentData , true);
                $extra = ['title' => $title , 'content' => $content , 'imageName' => $FinalName];
                $array_data[] = $extra;
                $final_data = json_encode($array_data);

                if(file_put_contents('data/content.json' , $final_data))
                {
                    echo 'Valid Data';
                }

            }*/


        $file = fopen('data/content.txt' , 'a');
        $allData = $title . ' | ' . $content . ' | ' . $FinalName . PHP_EOL;
        fwrite($file,$allData);
        fclose($file);


    }




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
</head>
<body>


<?php
    $file = fopen('data/content.txt' , 'r');

    while(! feof($file))
    {
        $line = fgets($file);
        $arrayOfData = explode('|' , $line);

        if(!empty($line))
        {
            echo '<br>';
            echo '<label for="">Title:</label>';
            echo "<label>" . $arrayOfData[0] . "</label>";
            echo '<br>';
            echo '<label for="">Content:</label>';
            echo "<label>" . $arrayOfData[1] . "</label>";
            echo '<br>';
            echo '<label for="">Image Path:</label>';
            $fullPath = trim($arrayOfData[2]);
            echo "<label>" . "uploads/$fullPath ". "</label>";
            echo '<br>';
            echo "<a href='delete.php?id=$fullPath'>Delete</a>";
            echo '<br>';
            echo '######################';

        }
    }

    fclose($file);

?>




</body>
</html>
