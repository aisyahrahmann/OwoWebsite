<?php
// Initialize the session
session_start();
//DASKDNASDNASDNAS
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="style2.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
    </style>
</head>
<body class="backgroundLg"">
<div>
    <a href="logout.php" class="Logout" style="text-align: center">Sign Out </a>
</div>
<div>
    <a href="index.php" class="Logout" >Next </a>
</div>
<div class="LogoutWelcome">
    <h1 style="color: #f1f1f1">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Your Pad.</h1>

</div>



</body>
</html>