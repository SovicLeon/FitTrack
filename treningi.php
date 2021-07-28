<?php include('include/glava.php'); ?>
<main>
    <br>
    <div class="container">
        <div id="seznam">
            <h2>Moji treningi</h2>
            <a href="dodajTrening.php">Dodaj trening!</a>
            <?php
                unset($_SESSION['idTrening']);
            ?>
            <br>

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
                $id = $_SESSION["id"];
                $sql = "SELECT ID, naziv, datum FROM trening WHERE uporabnikID=$id ORDER BY datum DESC";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    echo '<form class="trening"> <div>Naziv</div> <div>Datum</div> <div></div> </form>';
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)){
                      $datum = $row["datum"];
                      $leto = date('Y', strtotime($datum));
                      $mesec = date('m', strtotime($datum));
                      $dan = date('d', strtotime($datum));
                      $datum = $dan . "." . $mesec . "." . $leto;
                      echo '<form action="trening.php" method="POST" class="trening"><div>' . $row["naziv"] . "</div><div>" . $datum . "</div><input type=\"hidden\" name=\"idTrening\" value=\"" . $row["ID"] . "\">" . " <div>" . '<input type="submit" name="odTreningi" value="Podrobnosti"></div></form>';
                    }
                  } else {
                    echo "<form> Nimate treningov! </form>";
                  }
                  
                mysqli_close($conn);
            ?>
            
        </div>
    </div>
    <br>
</main>
<?php include('include/noga.php'); ?>