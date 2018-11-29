<?php
$dsn = "pgsql:"
. "host=ec2-54-225-196-122.compute-1.amazonaws.com;"
. "dbname=d4fg7upqlssb3k;"
. "user=yeixvihchwxhto;"
. "port=5432;"
. "sslmode=require;"
. "password=7e45cf8acf0d4631a68c43c355167a1f980c9099477722439f28c95edbf65e27";

$db = new PDO($dsn);
if(mysqli_connect_errno()){
    echo'database connection failed!!! '.mysqli_connect_error();
    die();
}

require_once $_SERVER['DOCUMENT_ROOT'].'/Furniture_Shop/config.php';
require_once BASEURL.'helpers/helpers.php';