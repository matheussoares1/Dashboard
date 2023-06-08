
<!-- Conexão com banco de dados do PHPmyAdmin -->

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vidrarias";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    die("Connect failed " . mysqli_connect_error());

}
/* echo "Sucessfully"; */



