
//3 - Chess Board
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chess Board</title>
    <style>
        .container{
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>

<div class="container">
    <table width="270px" cellspacing="0px" cellpadding="0px" border="1px">

        <?php


        for ($i = 1 ; $i <= 8 ; $i++)
        {
            echo '<tr>';
            for($j = 1 ; $j <= 8 ; $j++){

                $identityColor = $i + $j;
                if($identityColor % 2 == 0) {
                    echo '<td  style="background: white; width: 30px; height: 30px"   ></td>';
                }
                else {
                    echo '<td  style="background: black; width: 30px; height: 30px"   ></td>';
                }
            }
            echo '</tr>';
        }


        ?>

    </table>

</div>

</body>
</html>