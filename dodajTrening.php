<?php include('include/glava.php'); ?>
    <br>
    <div class="container">
        <div id="seznam">
            <h2>Dodaj trening</h2>
            <br>
            <form action="trening.php" method="GET">
                <input type="text" name="nazivTrening" placeholder="naziv treninga" required>
                <input type="date" name="datumTrening" placeholder="datum treninga">
                <input type="submit" value="DODAJ" name="dodajTrening">
            </form>

            <?php // izpis erorja
                unset($_SESSION['idTrening']);
                if(isset($_SESSION["error"])){
                    echo "<p style=\"color:red\">" . $_SESSION["error"] . "</p>";
                    unset($_SESSION['error']);
                }
            ?>

            <p> <br>Naziv dolžine 1 do 25 znakov. <br> Dovoljene so črke, številke in . ter _. <br> V primeru, da je datum neizpolnjen se nastavi na današni datum.</p>
        </div>
    </div>
    <br>
<?php include('include/noga.php'); ?>