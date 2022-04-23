<?php

session_start();
include 'constants.php';
class dbConnection
{
    private $con;

    public function __construct($server , $dbUser , $dbPassword , $dbName)
    {
        $this->con = mysqli_connect($server,$dbUser,$dbPassword,$dbName);

        if(!$this->con){
            echo 'Error , '.mysqli_connect_error();
            exit();
        }

    }



    public function getCon()
    {
        return $this->con;
    }

    public function doQuery($sql)
    {

        return  mysqli_query($this->con,$sql);
    }

    public function fetchRows($op)
    {
        return mysqli_fetch_row($op);
    }
    public function fetchAssocRows($op){
        return mysqli_fetch_assoc($op);
    }
}



