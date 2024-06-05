<?php

$localhost = "localhost"; /* change  to 3307 if 3307 is your default port */
$root = "root";
$password = "";
$database = "hospital_management";

    $connections = mysqli_connect($localhost, $root, $password, $database);

    if($connections->connect_errno){
        echo "Error:" .$connections->connect_errno;
    }
    else{

    }


