<?php //Connection file 
//$DATABASE_Host = "localhost";
//$DATABASE_dbUser = "root";
//$DATABASE_dbPassword ="password";
////$DATABASE_dbPassword ="";
//$mysqlConnect = mysqli_connect("$DATABASE_Host","$DATABASE_dbUser","$DATABASE_dbPassword") or die('Not connected : Ah sh*t ' . mysqli_connect_error());
//if ($mysqlConnect === false) {
//    die("My Sql is not Connected");
//}
//else {
//    mysqli_select_db($mysqlConnect,'bazaarceramics_db');
////    echo "Connection to server established";
//}

$host = "localhost";
$dbUsername = "root";
$dbPassword = "password";
$dbname = "bazaarceramics_db";


$conn = new mysqli($host, $dbUsername, $dbPassword,$dbname);



?>