<?php
session_start();
$count = 1;
$server = "localhost";
$user = "root";
$password = "";
$database = "registeration";

$user_name =  $_SESSION["username"];

$databaseconnection = mysqli_connect($server,$user,$password,$database);

if(mysqli_connect_errno())
{
    printf(
        '<h1>%s</h1> Error:%s',
        "Error connecting",
        mysqli_connect_error()
    );
    exit;
}

$result = mysqli_query($databaseconnection,"SELECT * FROM notes WHERE username='$user_name'");
if($result!==false){
    while($row= mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $count; echo(".")?></td>
            <td><b><?php echo ("Title: "); echo $row['title']; ?></b></td>
            <td><?php echo("Context: "); echo $row['text']; ?></td>
            <td><a href="delete.php?id=<?php echo $row['id']; ?>">&times;</a></td>
        </tr>
        <?php
        echo "<br/>";
        $count++;
    }
}
?>