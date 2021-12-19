<?php
// Initialize the session
session_start();

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

<div class="LogoutWelcome">
    <h1 style="color: #f1f1f1">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Your Pad.</h1>

</div>
<div class = "lolz"> 
<div class="loltext">
    <a href="index.php" class="Logout" >Next </a>
</div>
<div class="loltext">
 <a href="logout.php" class="Logout" >Sign Out </a>
</div>
</div>


</body>
</html>