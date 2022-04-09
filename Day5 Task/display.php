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
