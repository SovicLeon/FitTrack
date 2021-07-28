<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="FitTrack">
    <meta name="keywords" content="FitTrack">
    <meta name="author" content="Leon Sovič">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="icon" href="public/img/icon.jpg">
    <title>FitTrack</title>
</head>
<body>
    <nav>
        <a class="home" onclick="topFunction()" href="index.php">FitTrack</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
        <div id="myLinks">
            <a href="index.php"><i class="fa fa-home"></i></a>
            <a href="login.php" <?php if(isset($_SESSION['prijavljen'])){if($_SESSION['prijavljen']==true){echo 'style="display: none"';}} ?> >Prijava</a>
            <a href="register.php" <?php if(isset($_SESSION['prijavljen'])){if($_SESSION['prijavljen']==true){echo 'style="display: none"';}} ?> >Registracija</a>
            <a href="treningi.php" <?php if(isset($_SESSION['prijavljen'])){if($_SESSION['prijavljen']==false){echo 'style="display: none"';}}else if(!isset($_SESSION['prijavljen'])){echo 'style="display: none"';} ?> >Treningi</a>
            <a href="profil.php" <?php if(isset($_SESSION['prijavljen'])){if($_SESSION['prijavljen']==false){echo 'style="display: none"';}}else if(!isset($_SESSION['prijavljen'])){echo 'style="display: none"';} ?> >Profil</a>
            <a href="user/odjava.php" <?php if(isset($_SESSION['prijavljen'])){if($_SESSION['prijavljen']==false){echo 'style="display: none"';}}else if(!isset($_SESSION['prijavljen'])){echo 'style="display: none"';} ?> >Odjava</a>
            <span style="flex-grow: 1"></span>
            <a id="status" <?php if(isset($_SESSION['prijavljen'])){echo 'href="profil.php" style="border-bottom: 2px solid green"';}else{echo 'href="login.php" style="border-bottom: 2px solid red; margin: 1px;"';} ?>>
                <?php if(isset($_SESSION['prijavljen'])){if($_SESSION['prijavljen']==true){echo $_SESSION['uporabnik'];}}else{echo "NEPRIJAVLJENI";} ?>
            </a>
        </div>
    </nav>

    <script>
        var x = document.getElementById("myLinks");
        if (screen.width >= 670) {
            x.style.display = "flex";
        } else {
            x.style.display = "none";
        }

        function width () {
            if (screen.width >= 670) {
                return "row";
            } else {
                return "column";
            }
        }

        function myFunction() {
            var x = document.getElementById("myLinks");
            if (x.style.display === "flex") {
                x.style.display = "none";
                x.style.flex.direction = width();
            } else {
                x.style.display = "flex";
                x.style.flex.direction = width();
            }
        }
    </script>