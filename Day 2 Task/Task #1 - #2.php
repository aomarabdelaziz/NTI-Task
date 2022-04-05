

<?php
//'1 - Write a PHP function to print the next character of a specific character.'
function getNextChar($char)
{
    $nextChar = chr(ord($char) + 1 );
    return $nextChar;
}
 echo "Task #1 Solution: " . getNextChar('a');

echo "<br>";
// '1 - Write a PHP function to get the characters after the last '/' in an url. Go to the editor.'


function getCharacterAfterTheLastSlash($url){

    return substr($url , strrpos($url ,'/') + 1 );
}

echo "Task #2 Solution: " . getCharacterAfterTheLastSlash('http://www.example.com/5478631');




?>