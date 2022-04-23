<?php


class Validation
{
    public static function Clean($input)
    {
        return trim(strip_tags(stripslashes($input)));

    }
    public static function validate($input, $flag,$length = 6)
    {
        $status = true;

        switch ($flag) {
            case 'string' :
                #code
                if(is_numeric($input)){
                    $status = false;
                }
                break;
            case 'required':
                # code...
                if (empty($input)) {
                    $status = false;
                }
                break;
            case 'int':
                # code ...
                if (!filter_var($input, FILTER_VALIDATE_INT)) {
                    $status = false;
                }
                break;
            case 'min':
                # code ...
                if (strlen($input) < $length) {
                    $status = false;
                }
                break;
            case 'image':
                # Case

                $typesInfo  =  explode('/', $input['image']['type']);   // convert string to array ...
                $extension  =  strtolower(end($typesInfo));      // get last element in array ....

                $allowedExtension = ['png', 'jpeg', 'jpg'];   // allowed Extension    // PNG JPG

                if (!in_array($extension, $allowedExtension)) {

                    $status = false;
                }
                break;




        }

        return $status;
    }

}