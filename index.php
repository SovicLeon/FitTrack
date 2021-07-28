<?php include('include/glava.php'); // vključimo glavo?>

    <main>

        <div id="slika">
            <img src="public/img/n1.jpg" alt="slika telovadbe">
        </div>

        <div id="intro">
            <h2>Zakaj?</h2>
            <p class="text">Da imate vaš trening bolje pod nadzorom in da napredujete!</p>
        </div>

        <div id="paneli">
            <h2 style="color: black">Začnite!</h2>
            <div class="grid">
                <div class="panel" <?php if(isset($_SESSION['prijavljen'])){if($_SESSION['prijavljen']==true){echo 'style="display: none"';}} ?>> 
                    <h3>REGISTRACIJA</h3>
                    <p>Registrirajte se in začnite uporabljati FitTrack zastonj!</p>
                    <p></p>
                    <a href="register.php"></i>Registriraj se tukaj!</a>
    
                </div>

                <div class="panel" <?php if(isset($_SESSION['prijavljen'])){if($_SESSION['prijavljen']==true){echo 'style="display: none"';}} ?>> 
                    <h3>PRIJAVA</h3>
                    <p>Prijavite se in začnite!</p>
                    <p></p>
                    <a href="login.php"></i>Prijavite se tukaj!</a>
                </div>

                <div class="panel" <?php if(isset($_SESSION['prijavljen'])){if($_SESSION['prijavljen']==false){echo 'style="display: none"';}}else if(!isset($_SESSION['prijavljen'])){echo 'style="display: none"';} ?>> 
                    <h3>Treningi</h3>
                    <p>Preglejte vaše treninge!</p>
                    <br>
                    <a href="treningi.php"></i>TRENINGI</a>
                </div>

                <div class="panel" <?php if(isset($_SESSION['prijavljen'])){if($_SESSION['prijavljen']==false){echo 'style="display: none"';}}else if(!isset($_SESSION['prijavljen'])){echo 'style="display: none"';} ?>> 
                    <h3>Dodaj trening</h3>
                    <p>Dodajte trening in vpišite vaše vaje!</p>
                    <br>
                    <a href="dodajTrening.php"></i>DODAJ TRENING</a>
                </div>

                <div class="panel" <?php if(isset($_SESSION['prijavljen'])){if($_SESSION['prijavljen']==false){echo 'style="display: none"';}}else if(!isset($_SESSION['prijavljen'])){echo 'style="display: none"';} ?>> 
                    <h3>Zadnji trening</h3>
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
                        $sql = "SELECT ID, naziv, datum FROM trening WHERE uporabnikID=$id ORDER BY datum DESC LIMIT 1";
                        $result = mysqli_query($conn, $sql);
                        
                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)) {
                              echo '<form action="trening.php" method="POST">' . $row["naziv"] . " <br> " . $row["datum"] . "<br><input type=\"hidden\" name=\"idTrening\" value=\"" . $row["ID"] . "\">" . " " . '<input type="submit" name="odTreningi" value="Podrobnosti"> </form>';
                            }
                          } else {
                            echo "<form> Nimate treningov! </form>";
                          }
                          
                        mysqli_close($conn);
                    ?>
                    

                </div>

                <div class="panel" <?php if(isset($_SESSION['prijavljen'])){if($_SESSION['prijavljen']==false){echo 'style="display: none"';}}else if(!isset($_SESSION['prijavljen'])){echo 'style="display: none"';} ?>> 
                    <h3>Vaš profil</h3>
                    <p>Pogled na profil</p>
                    <br>
                    <a href="profil.php"></i>Profil</a>
                </div>
            </div>
        </div>

        <div id="tekst2">
            <h3>Pregled nad vašim napredkom</h3>
            <p>Imejte vse podatke o vaši telovadbi, pregled nad napredkom in nadzor nad vašo rastjo!</p>
        </div>


    </main>

<?php include('include/noga.php'); ?>