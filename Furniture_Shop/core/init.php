<?php
$db=mysqli_connect("127.0.0.1","root","","handy");
if(mysqli_connect_errno()){
    echo'database connection failed!!! '.mysqli_connect_error();
    die();
}

require_once $_SERVER['DOCUMENT_ROOT'].'/Furniture_Shop/config.php';
require_once BASEURL.'helpers/helpers.php';