<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){


        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $url = $_POST['url'];

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
        if(!filter_var($email, FILTER_SANITIZE_EMAIL)){
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
        if(!filter_var($url , FILTER_VALIDATE_URL)){
            $errors['url'] = 'URL must be valid url';
        }
        ///End [LinkUrl Validation]



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
<form action="<?php echo $_SERVER['PHP_SELF'];?>"   method="post">

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
        <button type="submit">Submit</button>

    </form>
</body>
</html>