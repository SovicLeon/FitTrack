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
                
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                if(isset($_SESSION["prijavljen"])){
                    $id = $_SESSION["id"];
                    $ime = $_SESSION["uporabnik"];

                    echo "<h2> $ime </h2>";

                    
                    echo '<form action="urediProfil.php" method="GET"><input type="submit" name="urediProfil" value="Uredi profil"></form>';

                    $sql = "SELECT email, rojstniDan, visina, teza FROM uporabnik WHERE ID = $id";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if(!empty($row["rojstniDan"])) {
                                $datum = $row["rojstniDan"];
                                $leto = date('Y', strtotime($datum));
                                $mesec = date('m', strtotime($datum));
                                $dan = date('d', strtotime($datum));
                                $datum = $dan . "." . $mesec . "." . $leto;
                            }
                            echo "<div class=\"profilContainer\"><div class=\"profilPodatek\"> Enaslov: </div><div class=\"profilPodatek\">" . $row["email"] . "</div></div>";
                            if(empty($row["rojstniDan"])){echo "<div class=\"profilContainer\">Rojstni dan: ni nastavljeno, nastavite pod Uredi profil</div>";} else{echo "<div class=\"profilContainer\"><div class=\"profilPodatek\">Rojstni dan: </div><div class=\"profilPodatek\">" . $datum . "</div></div>";}
                            if(empty($row["visina"])){echo "<div class=\"profilContainer\">Višina: ni nastavljeno, nastavite pod Uredi profil</div>";} else{echo "<div class=\"profilContainer\"><div class=\"profilPodatek\"> Višina: </div><div class=\"profilPodatek\">" . $row["visina"] . " cm </div></div>";}
                            if(empty($row["teza"])){echo "<div class=\"profilContainer\">Teža: ni nastavljeno, nastavite pod Uredi profil</div>";} else{echo "<div class=\"profilContainer\"><div class=\"profilPodatek\"> Teža: </div><div class=\"profilPodatek\">" . $row["teza"] . " kg </div></div>";}
                        }
                    } else {
                        mysqli_close($conn);
                        header('Location: index.php');
                    }


                    $sql = "SELECT COUNT(*) as stTreningov FROM trening WHERE uporabnikID = $id";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["stTreningov"]==0){echo "<div class=\"profilContainer\">Število treningov: ni vpisanih treningov</div>";} else{echo "<div class=\"profilContainer\"><div class=\"profilPodatek\">Število treningov: </div><div class=\"profilPodatek\">" . $row["stTreningov"] . "</div></div>";}
                        }
                    } else {
                        echo "<div class=\"profilContainer\">Število treningov: ni vpisanih treningov</div>";
                    }


                    $sql = "SELECT COUNT(vaja.ID) as stVaj FROM vaja INNER JOIN trening ON vaja.treningID=trening.ID WHERE trening.uporabnikID = $id";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["stVaj"]==0){echo "<div class=\"profilContainer\">Število vaj: ni vpisanih vaj</div>";} else{echo "<div class=\"profilContainer\"><div class=\"profilPodatek\">Število vaj: </div><div class=\"profilPodatek\">" . $row["stVaj"] . "</div></div>";}
                        }
                    } else {
                        echo "<div class=\"profilContainer\">Število vaj: ni vpisanih vaj</div>";
                    }

                } else{header('Location: index.php');}
            ?>
            
        </div>
    </div>
    <br>
</main>
<?php include('include/noga.php'); ?>