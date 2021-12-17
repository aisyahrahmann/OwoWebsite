<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "registeration";

$databaseconnection = mysqli_connect($server,$user,$password,$database);

$id = $_GET['id']; // get id through query string

$del = mysqli_query($databaseconnection,"delete from notes where id = '$id'"); // delete query

if($del)
{
    mysqli_close($databaseconnection); // Close connection
    header("location: index.php"); // redirects to all records page
    exit;
}
else
{
    echo "Error deleting record"; // display error message if not delete
}


?>
