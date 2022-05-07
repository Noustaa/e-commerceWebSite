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
    <?php include "./NavMenu.php" ?>
    <div class="leftPanel">
        <b>Catégories:</b>
        <ul>
            <a href="/src/Produits.php?categorie=Bonnets"><li>Bonnets</li></a>
            <a href="/src/Produits.php?categorie=Baskets"><li>Baskets</li></a>
            <a href=""><li>T-Shirts</li></a>
            <a href=""><li>Jeans</li></a>
            <a href=""><li>Manteau</li></a>
        </ul>
    </div>
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
        else{
            $query = "SELECT ID, Nom, Image, Soldes, Prix FROM produit;";
        }
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
                        <img class="itemPicture" src="<?php echo "$dataArray->Image" ?>">
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
        ?>
    </div>
</body>

</html>