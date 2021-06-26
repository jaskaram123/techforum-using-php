<?php 

$server = 'localhost';
$username = 'root';
$password = '';
$database_name = 'techforum';

$conn = mysqli_connect($server, $username, $password, $database_name);

if (!$conn) {
    die('Please try reloading the page' . mysqli_connect_error());
}

?>