<?php include('include/glava.php'); ?>
    <main>
    <div class="container">
        <div class="login">
            <h2>Registracija</h2>
            <form class="inside" action="user/register.php"  method="POST">
                <input type="text" name="ime" placeholder="Uporabniško ime" required>
                <input type="text" name="email" placeholder="Email" required>
                <input type="password" name="geslo1" placeholder="Geslo" required>
                <input type="password" name="geslo2" placeholder="Potrdi geslo" required>
                <input type="submit" value="Registriraj se" name="registracija">
                <input type="reset" value="Ponastavi">
            </form>
            <p>Že registrirani? <a href="login.php" class="bluer">Prijava! </a></p>
            <?php
                if(isset($_SESSION["odgovor"])){
                    echo '<p style="color: blue;">' . $_SESSION["odgovor"]  . '</p>';
                    unset($_SESSION['odgovor']);
                }
                
                if(isset($_SESSION["error"])){
                    echo '<p style="color: red;">' . $_SESSION["error"] . "</p>";
                    unset($_SESSION['error']);
                }
                echo '<p> <br>Ime dolžine 5 do 14 znakov in geslo dolžine od 8 do 20 znakov. <br> Dovoljene so črke, številke in . ter _.</p>'
            ?>  
        </div>
    </div>
    </main>
<?php
    session_unset();
    session_destroy();
?>