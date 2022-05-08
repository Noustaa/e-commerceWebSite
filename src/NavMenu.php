<?php session_start(); ?>

<link rel="stylesheet" href="/src/Style.css?v=<?php echo time(); ?>">

<div>
    <hr style="width:100%" , size="6" , color=black>
    <h1 style="text-align:center">E-Shop</h1>
    <hr style="width:50%" , size="3" , color=black>
    <h1 style="text-align:center">By Tanous & Salim</h1>
    <hr style="width:100%" , size="6" , color=black>
</div>

<nav style="text-align: center;">
    <div>
        <ul class="delPuces menuButtonStyle">
            <a href="/src/Home.php">
                <li>Accueil</li>
            </a>
            <a href="/src/Produits.php">
                <li>Produits</li>
            </a>
            <a href="">
                <li>A propos</li>
            </a>
            <a href="/src/Account.php">
                <li>Mon compte</li>
            </a>
        </ul>
    </div>
</nav>

<hr style="width:40%" , size="1" , color=black>

<?php
if ($_SESSION["logged_in"] != "yes") {
    ?>
       <p style="position:absolute;top:0;right:0;">Bonjour inconnu. Connectez vous ou enregistrez vous ici.</p>
    <?php
}
else {
    ?>
        <p style="position:absolute;top:0;right:0;">Bienvenue, <?php echo $_SESSION["username"]?>.</p>
        <?php
}
if ($_SESSION["addToCart"]){
    ?>
        <a href="/src/Cart.php">
            <div style="position:absolute;top:50px;right:20px;">
                <img src="/ressources/panierPlein.png">
                <p class="numberOfItemsInCart"><?php echo count($_SESSION["addToCart"]) ?></p>
            </div>
        </a>
    <?php
}
else {
    ?>
        <a href="/src/Cart.php">
            <img style="position:absolute;top:50px;right:20px;" src="/ressources/panierVide.png">
        </a>
    <?php
}
?>