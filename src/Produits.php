<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/Products.css?v=<?php echo time(); ?>">
    <title>Produits</title>
</head>

<body>
    <?php 
    if ($_POST["addToCart"])
    {
        if (!$_SESSION["addToCart"]){
            $_SESSION["addToCart"] = array($_POST["addToCart"]);
        }
        else{
            array_push($_SESSION["addToCart"], $_POST["addToCart"]);
        }     
    }
    include "./NavMenu.php";
    if (!$_GET["productItem"]){?>
    <div class="leftPanel">
        <b>Catégories:</b>
        <ul>
            <a href="/src/Produits.php?categorie=Bonnets"><li>Bonnets</li></a>
            <a href="/src/Produits.php?categorie=Baskets"><li>Baskets</li></a>
            <a href="/src/Produits.php?categorie=TShirts"><li>T-Shirts</li></a>
            <a href="/src/Produits.php?categorie=Jeans"><li>Jeans</li></a>
            <a href="/src/Produits.php?categorie=Manteaux"><li>Manteaux</li></a>
        </ul>
    </div>
    <?php } ?>
    <div class="productPanel">
        <?php
        $connect = mysqli_connect("localhost", "noustaa", "ssss");
        mysqli_select_db($connect, "dev");
        if ($_GET["categorie"] == "Bonnets"){
            $query = "SELECT ID, Nom, Image, Soldes, Prix FROM produit WHERE Categorie = 1;";
        }
        else if ($_GET["categorie"] == "Baskets"){
            $query = "SELECT ID, Nom, Image, Soldes, Prix FROM produit WHERE Categorie = 2;";
        }
        else if ($_GET["categorie"] == "TShirts"){
            $query = "SELECT ID, Nom, Image, Soldes, Prix FROM produit WHERE Categorie = 3;";
        }
        else if ($_GET["categorie"] == "Jeans"){
            $query = "SELECT ID, Nom, Image, Soldes, Prix FROM produit WHERE Categorie = 4;";
        }
        else if ($_GET["categorie"] == "Manteaux"){
            $query = "SELECT ID, Nom, Image, Soldes, Prix FROM produit WHERE Categorie = 5;";
        }
        else{
            $query = "SELECT ID, Nom, Image, Soldes, Prix FROM produit;";
        }
        if ($_GET["productItem"]){
            $query = "SELECT ID, Nom, Image, Soldes, Prix, Categorie, Stock, Description FROM produit WHERE ID = ".$_GET['productItem'].";";
            $runQuery = mysqli_query($connect, $query);
            $dataArray = mysqli_fetch_object($runQuery);
            ?>
                <div>   
                    <p>                 
                    <?php
                        if ($dataArray->Soldes != 0) { //Si il y a des soldes sur l'article
                            $discountedPrice = $dataArray->Prix - (($dataArray->Prix * $dataArray->Soldes) / 100);
                    ?>
                        <div class="onSaleShowItem">
                            <img class="showItem" src="<?php echo "$dataArray->Image" ?>">
                            <img class="soldePictureItem" src="../ressources/onSaleImage.png">
                        </div>
                            
                            
                            <p> <?php echo "$dataArray->Nom<br> Prix: <strike>{$dataArray->Prix}€</strike> ${discountedPrice}€<br> En soldes -$dataArray->Soldes%<br><br>$dataArray->Description" ?></p>
                    <?php
                        } else {
                    ?>
                            <img class="showItem" src="<?php echo "$dataArray->Image" ?>">
                            <p><?php echo "$dataArray->Nom<br> Prix: {$dataArray->Prix}€<br><br>$dataArray->Description" ?></p>
                    <?php
                        }
                    ?>
                        <br>
                        <br>
                        <form method="post">
                            <button type="submit" name="addToCart" value="<?php echo $dataArray->ID ?>">Ajouter au Panier</button>
                        </form>
                    </p>
                </div>
            <?php
        }

        if (!$_GET["productItem"]){
            $runQuery = mysqli_query($connect, $query);
            while (true) {
            ?>
                <div class="itemsRow">
                    <?php
                    for ($i = 0; $i < 4; $i++) { //To allow only 4 items per row
                    ?>
                        <div class="item">
                            <?php
                            if (($dataArray = mysqli_fetch_object($runQuery)) == NULL) {
                                break;
                            }
                            ?>
                            <a Style="color: inherit;" href="/src/Produits.php?productItem=<?php echo("$dataArray->ID")?>"><img class="itemPicture" src="<?php echo "$dataArray->Image" ?>"></a>
                            <?php
                            if ($dataArray->Soldes != 0) { //Si il y a des soldes sur l'article
                                $discountedPrice = $dataArray->Prix - (($dataArray->Prix * $dataArray->Soldes) / 100);
                            ?>
                                <img class="soldePicture" src="../ressources/onSaleImage.png">
                                <p> <?php echo "$dataArray->Nom<br> Prix: <strike>{$dataArray->Prix}€</strike> ${discountedPrice}€<br> En soldes -$dataArray->Soldes%" ?></p>
                            <?php
                            } else {
                            ?>
                                <p><?php echo "$dataArray->Nom<br> Prix: {$dataArray->Prix}€" ?></p>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            <?php

                if ($dataArray == NULL) {
                    break;
                }
            }
        }
        ?>
    </div>
</body>
</html>