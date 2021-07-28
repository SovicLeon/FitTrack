<?php
    // seja se začne in podatki za PB
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "sledilniktelovadbe";
                
    $conn = mysqli_connect($servername, $username, $password, $db);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // preverimo in izvedemo stavek na PB
    if(isset($_POST["vaja"])){
        $treningId = $_SESSION["idTrening"];
        $vajaNaziv = $_POST["nazivVaje"];
        $sets = $_POST["sets"];
        $reps = $_POST["reps"];
        $volumen = $_POST["volumen"];               
        $sql = "INSERT INTO vaja(treningID, nazivVajeID, sets, reps, volumen)
            VALUES ('$treningId', '$vajaNaziv', '$sets', '$reps', $volumen)";

        if (mysqli_query($conn, $sql)) {
            header('Location: ../trening.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else{
        header('Location: ../treningi.php');}
?>