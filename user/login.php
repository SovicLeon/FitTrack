<?php
    $imeErr = $gesloErr = $error = "";
    $ime = $geslo = "";
// testiranje vnešenih podatkov
    if ($_POST["prijava"]){
        if (empty($_POST["ime"])){
            $imeErr = "Ime je zahtevano! <br>";
        } else{
            $ime = test_input($_POST["ime"]);
            if (!preg_match("/^(?=[a-zA-Z0-9._]{5,14}$)(?!.*[_.]{2})[^_.].*[^_.]$/",$ime)) {
                $imeErr = "Nepravilno ime! <br>";
                $ime = "";
            }
        }
            
        if (empty($_POST["geslo"])){
            $gesloErr = "Geslo je zahtevano! ";
        } else{
            $geslo = test_input($_POST["geslo"]);
            if (!preg_match("/^(?=[a-zA-Z0-9._]{8,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/",$geslo)) {
                $gesloErr = "Nepravilno geslo!";
                $geslo = "";
            }
        }
    }

    $error = $imeErr . $gesloErr;
// funkcija za testiranje
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if((empty($error))&&(!empty($ime))&&(!empty($geslo))){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "sledilniktelovadbe";
                    
        $conn = mysqli_connect($servername, $username, $password, $db);
            // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $ime = $_POST["ime"];
        $geslo = $_POST["geslo"];
        
        $sql = "SELECT geslo FROM uporabnik WHERE ime = '$ime'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $hash = $row["geslo"];
            }
        } else {
            mysqli_close($conn);
            header('Location: ../login.php');
        }
// preverjanje gesla s geslom v PB
        if (password_verify($geslo, $hash)) {
            session_start();
            
            $sql = "SELECT id, ime FROM uporabnik WHERE ime = '$ime'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $id = $row["id"];
                    $ime = $row["ime"];
                }
            } else {
                mysqli_close($conn);
                header('Location: ../login.php'); // preusmeritev
            }
// nastavljanje sejnih spremenljivk
            $_SESSION["prijavljen"] = TRUE;
            $_SESSION["id"] = $id;
            $_SESSION["uporabnik"] = $ime;

            header('location: ../index.php');
        } else {
            mysqli_close($conn);
            session_start();
            $_SESSION["error"] = "Napačno geslo!";
            header('location: ../login.php');
        }

        mysqli_close($conn);
    } else{
        session_start();
        $_SESSION["error"] = $error;
        header('location: ../login.php');
    }
?>