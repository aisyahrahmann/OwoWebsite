<?php
session_start();
$server = "localhost";
$user = "root";
$password = "";
$database = "registeration";

$user_name = $_SESSION["username"];

$databaseconnection = mysqli_connect($server,$user,$password,$database);

if($databaseconnection) {
    echo "Connected Successfully";
}

$title = filter_input(INPUT_POST,'title');
$text = filter_input(INPUT_POST,'area');

//insert to database
$notes = "INSERT INTO notes(title,text,username)VALUES('$title','$text','$user_name')";
$data = mysqli_query($databaseconnection,$notes);

if($data){
    //    echo"New record created successfully";
}
else{
    echo "ERROR" .$notes. "<br>".mysqli_error($databaseconnection);
}
header("location: index.php");
?>