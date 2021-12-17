<?php
// Initialize the session
session_start();
include 'configuration.php';
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}


// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM users WHERE username = ?"; # select from table name users

        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }    
         // Close statement
         mysqli_stmt_close($stmt);
    }
    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OwO.Pad</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">

    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<section class="banner" id="sec">
    <header>
        <a href="#" class="logo">OwO.Pad</a>
        <div id="toggle" ondblclick="toggle()" ></div>
    </header>
    <div class="content">

        <h1>Welcome to OwO.Pad</h1>
        <p>“The digital note-taking app for your devices.”</p>
        <!-- Button to open the modal login form -->
        <button onclick="document.getElementById('id01').style.display='block'">Sign In
        </button>
    </div>


    <!-- The Modal -->
    <div id="id01" class="modal">
        <!-- form box -->
        <div class="fillcontainer">

            <form class="modal-content animate action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <span onclick="document.getElementById('id01').style.display='none'"
                  class="close" title="Close Modal">&times;</span>
            <div class="imgcontainer">
                <img src="Avatar2.png" alt="Avatar" class="avatar">
            </div>
            <h2 style="text-align: center">Login</h2>
            <p> </p>

            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">

                <a href="index.php">
                    <input  type="submit" class="btn btn-primary" value="Login" >
                </a>
            </div>

            <div class ="cancelcontainer">
                <p>Don't have an account? <a href="registration.php">Sign up now</a>.</p>
            </div>
            </form>
        </div>
</section>
<section class="section section-a">
    <div class="content">
        <h2>About</h2>
        <ul style="list-style-type:none;">
            <li> </li>
            <li style=font-size:1.5em>OwO.Pad is an website that is designed for note-taking and information storage</li>
            <li style=font-size:1.5em> Not similar to apps or website like Evernote and Apple Notes, it only let’s you </li>
            <li style=font-size:1.5em>store text which you can keep private.The idea of this website is taking</li>
            <li style=font-size:1.5em> from microsoft word  but this simpler and easier to use.</li>

    </div>
</section>

<section class="section section-b">
    <div class="content">
        <h2 style="padding-top: 10px">Contact Information</h2>
        <ul style="list-style-type:none;">
            <li style="font-size: 1.2rem">Locate us: One Apple Park Way,Cupertino, California, United States</li>
            <li style="font-size: 1.2rem">Send us an Email: OwO.pad@gmail.com</li>
        </ul>
    </div>
    <p style="text-align: right">&copy; Copyright 2020 OwO.pad</p>
</section>
<div id="navigation">
    <ul>
        <li><a href="registration.php">Create a Account</a> </li>
    </ul>
</div>
<script type="text/javascript">
    function toggle(){
        var sec = document.getElementById('sec');
        var nav = document.getElementById('navigation');
        sec.classList.toggle('active');
        nav.classList.toggle('active');
    }
</script>
</body>
</html>
