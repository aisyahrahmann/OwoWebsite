<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "registeration";

$databaseconnection = mysqli_connect($server,$user,$password,$database);

mysqli_select_db($database, $databaseconnection);


$truncatetable= mysqli_query($databaseconnection, "DELETE FROM notes;");

if($truncatetable !== FALSE)
{
    //echo("All rows have been deleted.");
    mysqli_close($databaseconnection); // Close connection
    header("location: index.php"); // redirects to all records page
    exit;
}
else
{
    echo("No rows have been deleted.");
}

?>

