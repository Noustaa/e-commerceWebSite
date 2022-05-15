<?php session_start(); ?>

<script>
    function toggleDisplayDiv()
    {
        var loginPopup = document.getElementById("loginPopup");
        if (loginPopup.style.display == "none"){
            loginPopup.style.display = "block";
        }
        else{
            loginPopup.style.display = "none";
        }
    }
</script>

<link rel="stylesheet" href="Style.css?v=<?php echo time(); ?>">

<div>
    <hr style="width:100%" , size="6" , color=black>
    <h1 style="text-align:center; margin: 0;">E-Shop</h1>
    <hr style="width:50%" , size="3" , color=black>
    <h1 style="text-align:center;margin: 0;">By Tanous & Salim</h1>
    <hr style="width:100%; margin-bottom: 0;" , size="6" , color=black>
</div>

<nav style="text-align: center;">
    <div>
        <ul class="delPuces menuButtonStyle navBarUl">
            <a href="Home.php">
                <li>Accueil</li>
            </a>
            <a href="Produits.php">
                <li>Produits</li>
            </a>
            <a href="">
                <li>A propos</li>
            </a>
            <a href="Account.php">
                <li>Mon compte</li>
            </a>
            <?php
            if ($_SESSION["isAdmin"] == "yes") {
            ?>
            <a href="AdminPanel.php">
                <li>Administration</li>
            </a>
            <?php
                }
            ?>
        </ul>
    </div>
</nav>

<hr style="width:40%;margin-top: 0;" , size="1" , color=black>

<?php
if ($_SESSION["logged_in"] != "yes") {
    ?>
       <p style="position:absolute;top:5px;right:20px;margin-bottom:0">Bienvenue, <a href="javascript:toggleDisplayDiv()">connectez-vous</a> ou <a href="Register.php">enregistrez vous.</a></p>
    <?php
}
else {
    ?>
        <p style="position:absolute;top:0;right:10px;margin-bottom: 0;">Bienvenue, <?php echo $_SESSION["username"]?>.</p>
        <a href="Logout.php" style="position:absolute;top:30px;right:15px;">Se déconnecter</a>
        <?php
}
if ($_SESSION["addToCart"]){
    ?>
        <a href="Cart.php">
            <div style="position:absolute;top:50px;right:20px;">
                <img src="/ressources/panierPlein.png">
                <p class="numberOfItemsInCart"><?php echo count($_SESSION["addToCart"]) ?></p>
            </div>
        </a>
    <?php
}
else {
    ?>
        <a href="Cart.php">
            <img style="position:absolute;top:50px;right:20px;" src="/ressources/panierVide.png">
        </a>
    <?php
}
if ($_SESSION["isAdmin"] == "yes") {
    ?>
        <H1 class="adminFlag">ADMIN</H1>
    <?php
}
?>
<div class="loginPopup" id="loginPopup" style="display: none">
        <input type="image" src="/ressources/close.png" onclick="toggleDisplayDiv()">
        <form name="Form" action="Connect.php" method="POST">
            <div>
                <label for="user">Identifiant:</label>
                <input type="text" id="user" name="user" />
            </div>
            <div>
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" />
            </div>
            <div>
                <button type="submit">Connexion</button>
            </div>
        </form>
    </div>