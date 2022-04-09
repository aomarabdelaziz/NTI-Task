<?php

if(isset($_GET['id']))
{
    $idByPath = $_GET['id'];
    $file = fopen('data/content.txt' , 'r');

    $textContent = '';

    while(! feof($file))
    {
        $line = fgets($file);
        $arrayOfData = explode('|' , $line);

        if(!empty($line))
        {
            $fullPath = trim($arrayOfData[2]);
            $allData = $title . ' | ' . $content . ' | ' . $fullPath . PHP_EOL;
            if($fullPath != $idByPath) {

                $textContent .=$allData;
            }

        }
    }

    fclose($file);



    $file = fopen('data/content.txt' , 'w');
    fwrite($file , $textContent);
    fclose($file);

    if($file) {
        echo 'Blog is deleted';
    }
    else {
        echo 'Error occurred while deleting';
    }
}