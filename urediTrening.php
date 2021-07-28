<?php include('include/glava.php'); ?>
<main>
    <br>
    <div class="container">
        <div id="seznam">
            
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $db = "sledilniktelovadbe";
                
                $conn = mysqli_connect($servername, $username, $password, $db);
                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                if(isset($_POST["odstraniTrening"])){
                    $_SESSION["odstraniTrening"] = true;
                    header('Location: user/odstraniTrening.php');
                } else if(isset($_SESSION["idTrening"])){
                    $treningId = $_SESSION["idTrening"];
                    
                    $sql = "SELECT naziv, datum FROM trening WHERE ID=$treningId";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $naziv = $row["naziv"];
                            $datum = $row["datum"];
                        }
                    } else {
                        header('Location: treningi.php');
                    }

                    $leto = date('Y', strtotime($datum));
                    $mesec = date('m', strtotime($datum));
                    $dan = date('d', strtotime($datum));
                    $datum = $dan . "." . $mesec . "." . $leto;

                    echo "<h2>" . $naziv . "<span style=\"color: #006b68;\"> - </span>" . $datum . "</h2><br>";
                    
                    echo '<form action="user/urediTrening.php" method="POST"><input type="text" name="nazivTrening" placeholder="nov naziv"><input type="submit" name="urediTrening" value="Spremeni naziv"></form>';

                    echo '<form action="user/urediTrening.php" method="POST"><input type="date" name="datumTrening" placeholder="nov datum"><input type="submit" name="urediTrening" value="Spremeni datum"></form>';

                    if(isset($_SESSION["error"])){
                        echo "<p style=\"color: red;\">" . $_SESSION["error"] . "</p>";
                        unset($_SESSION['error']);
                    }

                } else{header('Location: treningi.php');}
            ?>
            
        </div>
    </div>
    <br>
</main>
<?php include('include/noga.php'); ?>