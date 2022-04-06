<?php




if($_SERVER['REQUEST_METHOD'] == "POST"){


        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $url = $_POST['url'];
        $gender = $_POST['gender'];

        $errors = [];

        ///[Name Validation]
        if(empty($name)){
            $errors['name'] = 'Required';
        }
        if(is_numeric($name)){
            $errors['name'] = 'Name must be string';
        }
        ///End [Name Validation]

        ///[Email Validation]
        if(empty($email)){
            $errors['email'] = 'Required';
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Email must be a valid email';
        }
        ///End [Email Validation]

        ///[Password Validation]
        if(empty($password)){
            $errors['password'] = 'Required';
        }
        if(strlen($password) < 6){
            $errors['password'] = 'Password length mus be at least 6 characters';
        }
        ///End [Password Validation]

        //[Address Validation]
        if(empty($address)){
            $errors['address'] = 'Required';
        }
        if(strlen($address) < 10){
            $errors['password'] = 'Address length mus be at least 10 characters';
        }
        ///End [Address Validation]

        //[LinkUrl Validation]
        if(empty($url)){
            $errors['url'] = 'Required';
        }
        if(!filter_var($url,FILTER_VALIDATE_URL)){
            $errors['url'] = 'URL must be valid url';
        }
        ///End [LinkUrl Validation]


       $allowedGender = ['male' , 'female'];
        if(!in_array($gender,$allowedGender))
        {
            $errors['gender'] = 'please Select a valid gender';
        }



        if (!empty($_FILES['cv']['name']))
        {
            $name    = $_FILES['cv']['name'];
            $temPath = $_FILES['cv']['tmp_name'];
            $size    = $_FILES['cv']['size'];
            $type    = $_FILES['cv']['type'];
            $typesInfo  =  explode('/', $type);   // convert string to array ...
            $extension  =  strtolower( end($typesInfo));      // get last element in array ....

            $allowedExtension = ['pdf'];   // allowed Extension    // PDF

            if (in_array($extension, $allowedExtension)) {

                $FinalName = time() . rand() . '.' . $extension;
                $disPath = 'uploads/' . $FinalName;

                if (!move_uploaded_file($temPath, $disPath)) {

                    $errors['cv'] = "error occurred while uploading the PDF";
                }
            }
            else {
                $errors['cv'] = "PDF extension is only allowed";
            }
        }
        else {
            $errors['CV'] = "CV is required";
        }


        if(count($errors) > 0) {

            foreach($errors as $key => $value){
                echo '* '.$key.' : '.$value.'<br>';
            }
        }
        else {
            echo 'Valid Data';
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
<form action="<?php echo $_SERVER['PHP_SELF'];?>"   method="post" enctype="multipart/form-data">

        <label for="">Name:</label>
        <input type="text" name="name">
        <br>
        <label for="">Email:</label>
        <input type="email" name="email">
        <br>
        <label for="">Password:</label>
        <input type="password" name="password">
        <br>
        <label for="">Address:</label>
        <input type="text" name="address">
        <br>
        <label for="">Linkedin Url:</label>
        <input type="text" name="url">
        <br>
        <label for="">Gender:</label>
         <select name="gender" id="">
             <option value="male">Male</option>
             <option value="female">Female</option>
         </select>
        <br>
         <label for="">CV PDF:</label>
         <input type="file" name="cv">
         <br>
         <button type="submit">Submit</button>

    </form>
</body>
</html>