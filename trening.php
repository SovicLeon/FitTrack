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

                function test_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                
                if((isset($_POST["idTrening"]))||(isset($_SESSION["idTrening"]))){
                    if(isset($_POST["idTrening"])){$_SESSION["idTrening"] = $_POST["idTrening"];}
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
                }else if(isset($_GET["dodajTrening"])){
                    $error = "";

                    if(!empty($_GET["datumTrening"])){
                        $datum = $_GET["datumTrening"];
                    } else{
                        $datum = date('Y-m-d');
                    }

                    $naziv = $_GET["nazivTrening"];

                    $naziv = test_input($naziv);
                    if(!preg_match("/^[a-zA-Z0-9._]{1,25}$/",$naziv)){
                        $error = $error . "Neveljavni naziv! <br>";
                    } else{
                        $datum = test_input($datum);
                        if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$datum)){
                            $error = $error . "Neveljavni datum! <br>";
                        } else{
                            $sql = "INSERT INTO trening(uporabnikID, naziv, datum)
                            VALUES (".$_SESSION["id"].", '$naziv', '$datum')";

                            if (mysqli_query($conn, $sql)) {
                                $last_id = mysqli_insert_id($conn);
                                $_SESSION["idTrening"] = $last_id;
                                $treningId = $_SESSION["idTrening"];
                            } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            } 
                        }
                    }
                    if(!empty($error)){ // kadar so erorji nas premakne iz datoteke
                        $_SESSION["error"] = $error;
                        header('Location: dodajTrening.php');
                    } 
                }
                
                $leto = date('Y', strtotime($datum));
                $mesec = date('m', strtotime($datum));
                $dan = date('d', strtotime($datum));
                $datum = $dan . "." . $mesec . "." . $leto;

                echo "<h2>" . $naziv . "<span style=\"color: #006b68;\"> - </span>" . $datum . "</h2><br>";
                echo '<form action="urediTrening.php" method="POST">' . "<input type=\"hidden\" name=\"idTrening\" value=\"" . $treningId . "\">" . '<input type="submit" name="odstraniTrening" value="Odstrani trening"> <input type="submit" name="urediTrening" value="Uredi trening"> </form>';

                echo    '<form action="user/dodajVajo.php" method="POST">
                        <select name="nazivVaje" required>
                        <option disabled selected>  izberite vajo  </option>';

                        $sql = "SELECT ID, naziv FROM nazivvaje";
                        $result = mysqli_query($conn, $sql);
            
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row["ID"] . '">' . $row["naziv"] . '</option>';
                            }
                        } else {header('Location: index.php');}

                echo    '</select><input type="number" name="sets" placeholder="serije" required>
                        <input type="number" name="reps" placeholder="ponovitve" required>
                        <input type="number" name="volumen" placeholder="volumen[kg]" required><br>
                        <input type="submit" name="vaja" value="DODAJ"></form>';



                if(isset($treningId)){
                    $sql = "SELECT vaja.id, nazivvaje.naziv, vaja.reps, vaja.sets, vaja.volumen FROM vaja, nazivvaje WHERE vaja.nazivVajeID=nazivvaje.ID AND vaja.treningID=$treningId ORDER BY vaja.id DESC";
                    $result = mysqli_query($conn, $sql);
        
                    if (mysqli_num_rows($result) > 0){
                        echo '<form class="vaja"> <span>Vaja</span> <span>Serije</span> <span>Ponovitve</span> <span>Volumen(kg)</span> <span></span></form>';
                        while($row = mysqli_fetch_assoc($result)){
                        echo '<form action="user/odstraniVajo.php" method="POST" class="vaja"><span>' . $row["naziv"]. "</span><span>" . $row["sets"]. "</span><span>" . $row["reps"] . "</span><span>" . $row["volumen"] . '</span><input type="hidden" name="id" value="' . $row["id"] . '">' . '<input type="submit" name="odstrani" value="odstrani" id="odstraniVajo">' . '</form>';
                        }
                    } else {
                        echo "<form>Trening nima vaj! </form>";
                    }
                }
                

                mysqli_close($conn);
            ?>
            
        </div>
    </div>
    <br>
</main>
<?php include('include/noga.php'); ?>