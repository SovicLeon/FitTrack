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
    if(isset($_SESSION['odstraniTrening'])){
        $treningId = $_SESSION["idTrening"];
        
        $sql = "DELETE FROM vaja WHERE treningID=$treningId";

        unset($_SESSION['odstraniTrening']);
        
        if (mysqli_query($conn, $sql)) {
            $sql = "DELETE FROM trening WHERE ID=$treningId";
        
            if (mysqli_query($conn, $sql)) {
                header('Location: ../treningi.php');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else{//header('Location: ../treningi.php');
        header('Location: ../treningi.php');}
?>