<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,
       initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel = "stylesheet" href = "style3.css">
    <script src="function.js"></script>
    <title>OwO.pad</title>
</head>
<body>
<div class = "background">
    <div class ="overlay"></div>
    <div id = "Boxed">
        <div class="Edit" style="float:right;">
            <button class="Edit button">Edit</button>
            <div class="Edit-content">
                <a href="deleteAll.php">Delete All</a>
            </div>
        </div>
        <h1><b>My notes</b></h1>
        <div class ="listed">
            <?php
            include "display.php";
            ?>
        </div>
        <a href="welcome.php " class="sing" style="float: bottom">&#8249; Back</a>
        <a href="#" class="Add" onclick="return show('container','Boxed');">New Note </a>
    </div>

    <div id = "container" style="display: none">
        <a href="#" class="back" onclick="return show('Boxed','container');">&#8249; Back</a>
        <p><span id="time"></span></p>
        <script>
            let dt = new Date();
            var t = document.getElementById("time").innerHTML = dt.toLocaleString();
        </script>
        <form method="post" action="app.php">
            <button id="save" style="float:right;" type ="submit" value = "submit" >Save</button>
            <input name="title" id="title" type="text" placeholder="Title your note">
            <textarea name="area" id ="area" placeholder="Text here"></textarea>
        </form>
    </div>
</div>
</body>
</html>
