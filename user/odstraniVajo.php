<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "sledilniktelovadbe";
                
    $conn = mysqli_connect($servername, $username, $password, $db);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if(isset($_POST["odstrani"])){
        $treningId = $_SESSION["idTrening"];
        $vajaID = $_POST["id"];              
        $sql = "DELETE FROM vaja WHERE ID=$vajaID";

        if (mysqli_query($conn, $sql)) {
            header('Location: ../trening.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else{//header('Location: ../treningi.php');
        header('Location: ../treningi.php');}
?>