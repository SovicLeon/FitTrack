<?php include('include/glava.php'); ?>
<main>
    <br>
    <div class="container">
        <div id="seznam">
            
            <?php
                if(isset($_SESSION["prijavljen"])){
                    $id = $_SESSION["id"];
                    $ime = $_SESSION["uporabnik"];

                    echo "<h2> $ime </h2>";

                    echo '<form action="user/urediProfil.php" method="POST"><input type="text" name="ime" placeholder="novo ime" required><input type="submit" name="urediProfil" value="Spremeni ime"></form>';

                    echo '<form action="user/urediProfil.php" method="POST"><input type="password" name="geslo" placeholder="novo geslo" required><input type="submit" name="urediProfil" value="Spremeni geslo"></form>';

                    echo '<form action="user/urediProfil.php" method="POST"><input type="date" name="datum" placeholder="nov datum" required><input type="submit" name="urediProfil" value="Spremeni roj. dan"></form>';

                    echo '<form action="user/urediProfil.php" method="POST"><input type="text" name="email" placeholder="novi enaslov" required><input type="submit" name="urediProfil" value="Spremeni enaslov"></form>';

                    echo '<form action="user/urediProfil.php" method="POST"><input type="number" name="visina" placeholder="nova višina[cm]" required><input type="submit" name="urediProfil" value="Spremeni visino"></form>';

                    echo '<form action="user/urediProfil.php" method="POST"><input type="number" name="teza" placeholder="nova teža[kg]" required><input type="submit" name="urediProfil" value="Spremeni težo"></form>';

                    if(isset($_SESSION["sporocilo"])){
                        echo "<p style=\"color: red;\">" . $_SESSION["sporocilo"] . "</p>";
                        unset($_SESSION['sporocilo']);
                    }
                } else{header('Location: index.php');}
            ?>
            
        </div>
    </div>
    <br>
</main>
<?php include('include/noga.php'); ?>