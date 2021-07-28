<?php include('include/glava.php'); ?>
    <main>
    <div class="container">
        <div class="login">
            <h2>Prijava</h2>
            <form class="inside" action="user/login.php"  method="POST">
                <input type="text" name="ime" placeholder="ime" required>
                <input type="password" name="geslo" placeholder="geslo" required>
                <input type="submit" value="Prijavi se" name="prijava">
                <input type="reset" value="Ponastavi">
            </form>
            <p class="manjse">Se še niste registrirali? <a href="register.php" class="bluer">Registracija!</a></p>

            <?php
                if(isset($_SESSION["error"])){
                    echo '<p style="color: red; style-size: 100%;">' . $_SESSION["error"] . "</p>";
                    unset($_SESSION['error']);
                }
            ?>
        </div>
    </div>
    </main>
<?php
    session_unset();
    session_destroy();
?>
