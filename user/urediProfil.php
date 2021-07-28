<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "sledilniktelovadbe";
    
    $conn = mysqli_connect($servername, $username, $password, $db);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_SESSION["prijavljen"])){
        $id = $_SESSION["id"];

        if(isset($_POST["urediProfil"])){
            // nastavim error in sporočila
            $imeErr = $gesloErr = $emailErr = $visinaErr = $tezaErr = $datumErr = $sporocilo = "";

            // ime update
            if(isset($_POST["ime"])){
                $ime = test_input($_POST["ime"]);
                if(!preg_match("/^(?=[a-zA-Z0-9._]{5,14}$)(?!.*[_.]{2})[^_.].*[^_.]$/",$ime)){
                    $imeErr = "Neveljavno ime! <br>";
                } else{
                    $sql = "SELECT ime FROM uporabnik WHERE ime = '$ime'";
                    $result = mysqli_query($conn, $sql);

                    $row = mysqli_fetch_assoc($result);
                    $imeDB = $row["ime"];

                    if(empty($imeDB)){
                        $sql = "UPDATE uporabnik SET ime='$ime' WHERE ID=$id";
                        mysqli_query($conn, $sql);
                        $_SESSION["uporabnik"] = $ime;
                        
                        $sporocilo = "Ime posodobljeno!";
                    } else{
                        $imeErr = $imeErr . "Ime je že uporabljeno! <br>";
                    }
                }
            }

            // enaslov update
            if(isset($_POST["email"])){
                $email = test_input($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $emailErr = "Neveljaven email format! <br>";
                } else{
                    $sql = "SELECT email FROM uporabnik WHERE email = '$email'";
                    $result = mysqli_query($conn, $sql);

                    $row = mysqli_fetch_assoc($result);
                    $emailDB = $row["email"];

                    if(empty($emailDB)){
                        $sql = "UPDATE uporabnik SET email='$email' WHERE ID=$id";
                        mysqli_query($conn, $sql);
                        
                        $sporocilo = "Enaslov posodobljen!";
                    } else{
                        $emailErr = $emailErr . "Enaslov je že uporabljen! <br>";
                    }
                }
            } 
            
            // geslo update
            if(isset($_POST["geslo"])){
                $geslo = test_input($_POST["geslo"]);
                if(!preg_match("/^(?=[a-zA-Z0-9._]{8,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/",$geslo)){
                    $gesloErr = "Neveljavno geslo! <br>";
                } else{
                    $options = [
                        'cost' => 8,
                    ];
                    $geslo = password_hash($geslo, PASSWORD_BCRYPT, $options);

                    $sql = "UPDATE uporabnik SET geslo='$geslo' WHERE ID=$id";
                    mysqli_query($conn, $sql);
                        
                    $sporocilo = "Geslo posodobljeno!";
                }
            }

            // datum update ^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$
            if(isset($_POST["datum"])){
                $datum = test_input($_POST["datum"]);
                if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$datum)){
                    $datumErr = "Neveljavni datum! <br>";
                } else{
                    $sql = "UPDATE uporabnik SET rojstniDan='$datum' WHERE ID=$id";
                    mysqli_query($conn, $sql);

                    $sporocilo = "Datum rojstva posodobljen!";
                }
            } 


            // višina update
            if(isset($_POST["visina"])){
                $visina = test_input($_POST["visina"]);
                if(!preg_match("/^[0-9]*$/",$visina)){
                    $visinaErr = "Neveljavna višina! <br>";
                } else{
                    $sql = "UPDATE uporabnik SET visina='$visina' WHERE ID=$id";
                    mysqli_query($conn, $sql);

                    $sporocilo = "Visina posodobljena!";
                }
            } 

            // teža update
            if(isset($_POST["teza"])){
                $teza = test_input($_POST["teza"]);
                if(!preg_match("/^[0-9]*$/",$teza)){
                    $tezaErr = "Neveljavna teža! <br>";
                } else{
                    $sql = "UPDATE uporabnik SET teza='$teza' WHERE ID=$id";
                    mysqli_query($conn, $sql);

                    $sporocilo = "Teza posodobljena!";
                }
            } 

        }

        $_SESSION["sporocilo"] = $imeErr . $gesloErr . $emailErr . $visinaErr . $tezaErr . $datumErr . $sporocilo;
        header('Location: ../urediProfil.php');

    } else{header('Location: index.php');}
?>