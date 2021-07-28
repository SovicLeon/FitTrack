<?php
    $imeErr = $geslo1Err = $geslo2Err = $emailErr = $error = "";
    $ime = $geslo1 = $geslo2 = $email = ""; // nastavimo erorje
    // funkcija za preverjanje podatkov
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    // z IF stavki preverjanje pristnosti podatkov
    if(isset($_POST["registracija"])){
        if(($_POST["geslo1"])==($_POST["geslo2"])){
            if (empty($_POST["ime"])){
                $imeErr = "Ime je zahtevano! <br>";
            } else{
                $ime = test_input($_POST["ime"]);
                if (!preg_match("/^(?=[a-zA-Z0-9._]{5,14}$)(?!.*[_.]{2})[^_.].*[^_.]$/",$ime)){
                    $imeErr = "Neveljavno ime! <br>";
                    $ime = "";
                }
            }

            if (empty($_POST["email"])){
                $emailErr = "Email je zahtevan! <br>";
            } else{
                $email = test_input($_POST["email"]);
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                  $emailErr = "Neveljaven email format! <br>";
                  $email = "";
                }
            }
                
            if(empty($_POST["geslo1"])){
                $geslo1Err = "Geslo je zahtevano! <br>";
            } else{
                $geslo = test_input($_POST["geslo1"]);
                if (!preg_match("/^(?=[a-zA-Z0-9._]{8,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/",$geslo)){
                    $geslo1Err = "Neveljavno geslo! <br>";
                    $geslo = "";
                }
            }
        } else{
            $geslo2Err = "Gesli se ne ujemata! <br>";
        }
    } else{
        header('location: ../index.php');
    }

    $error = $imeErr . $geslo1Err . $geslo2Err . $emailErr;

    if ((isset($_POST["ime"]))&&(isset($_POST["email"]))&&(isset($_POST["geslo1"]))&&(empty($error))){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "sledilniktelovadbe";
                    
        $conn = mysqli_connect($servername, $username, $password, $db);
            // Check connection
        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }

        $ime = $_POST["ime"];
        $email = $_POST["email"];
        $geslo = $_POST["geslo1"];
        
        $sql = "SELECT ime FROM uporabnik WHERE ime = '$ime'";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
        $imeDB = $row["ime"];

        $sql = "SELECT email FROM uporabnik WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
        $emailDB = $row["email"];

        if((empty($imeDB))&&(empty($emailDB))){ // če uporabnik ne obstaja nadaljujemo
            $options = [    // kriterij za hash
                'cost' => 8,
            ];
            $geslo = password_hash($geslo, PASSWORD_BCRYPT, $options); // ustvarimo geslo
            // vpis v PB
            $datum = date('Y-m-d');
            $sql = "INSERT INTO uporabnik (ime, geslo, email, datRegistracije)
            VALUES ('$ime', '$geslo', '$email', '$datum')";
            $result = mysqli_query($conn, $sql);
            $odgovor = 'Uporabnik ustvarjen!';
        } else{
            $odgovor = 'Uporabnik ali enaslov že obstaja!';
        }
    } else{
        session_start();
        $_SESSION["error"] = $error;
        echo $error;
        header('location: ../register.php');
    }
    mysqli_close($conn);
    session_start();
    $_SESSION["odgovor"] = $odgovor; 
    header('location: ../register.php');
?>