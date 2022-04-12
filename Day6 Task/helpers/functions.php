<?php

function Clean($input)
{
    return   trim(strip_tags(stripslashes($input)));

}
?>