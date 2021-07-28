<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "sledilniktelovadbe";
 
    session_start();

    $conn = mysqli_connect($servername, $username, $password, $db);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if(isset($_POST["urediTrening"])){
        $treningId = $_SESSION["idTrening"];
        
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if(isset($_POST["urediTrening"])){
            if(isset($_POST["nazivTrening"])){
                $nazivTrening = $_POST["nazivTrening"];

                $naziv = $_POST["nazivTrening"];

                $naziv = test_input($naziv);
                if(!preg_match("/^[a-zA-Z0-9._]{1,25}$/",$naziv)){
                    $error = $error . "Neveljavni naziv! <br>";
                } else{
                    $sql = "UPDATE trening SET naziv='$nazivTrening' WHERE id=$treningId";
                    mysqli_query($conn, $sql);
                }
            } else if(isset($_POST["datumTrening"])){
                $datum = $_POST["datumTrening"];

                $datum = test_input($datum);
                if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$datum)){
                    $error = $error . "Neveljavni datum! <br>";
                } else{
                    $sql = "UPDATE trening SET datum='$datum' WHERE id=$treningId";
                    mysqli_query($conn, $sql);
                }
            }

            if(!empty($error)){
                $_SESSION["error"] = $error;
                header('Location: ../urediTrening.php');
            } else{header('Location: ../treningi.php');}

        }

    } else{header('Location: ../treningi.php');}
?>