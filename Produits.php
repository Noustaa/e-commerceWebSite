<?php session_start();?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Products.css?v=<?php echo time(); ?>">
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
            <a href="Produits.php?categorie=Bonnets"><li>Bonnets</li></a>
            <a href="Produits.php?categorie=Baskets"><li>Baskets</li></a>
            <a href="Produits.php?categorie=TShirts"><li>T-Shirts</li></a>
            <a href="Produits.php?categorie=Jeans"><li>Jeans</li></a>
            <a href="Produits.php?categorie=Manteaux"><li>Manteaux & Blousons</li></a>
        </ul>
    </div>
    <?php } ?>
        <?php
        $connect = mysqli_connect("localhost", "u545314609_tanous", "f:0~*J5=Zo", "u545314609_eshop1");
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
                <div class="productTitle">
                    <H1 class="productTitleH1"><?php echo $dataArray->Nom ?></H1>
                </div>
                <div class="productWrapper">   
                    <div class="productImage">
                        <div>
                            <?php
                                if($dataArray->Soldes != 0){
                                    ?>
                                        <img class="soldePictureItemPage" src="/ressources/onSaleImage.png">
                                    <?php
                                }
                            ?>
                            <img class="productImageImg" src="<?php echo $dataArray->Image ?>">
                        </div>
                    </div>
                    <div class="productDetails">
                        <p>Description: <?php echo $dataArray->Description ?></p>
                        <?php
                                if($dataArray->Soldes != 0){
                                    $discountedPrice = $dataArray->Prix - (($dataArray->Prix * $dataArray->Soldes) / 100);
                                    ?>
                                        <p>Prix: <strike><?php echo $dataArray->Prix ?>€</strike> -<?php echo $dataArray->Soldes."% => ". $discountedPrice ?>€</p>
                                    <?php
                                }
                                else{
                                    ?>
                                        <p>Prix: <?php echo $dataArray->Prix ?>€</p>
                                    <?php
                                }
                            ?>
                        <form method="post">
                            <button type="submit">
                                <p>Ajouter au panier</p>
                                <input type="hidden" name="addToCart" value="<?php echo $dataArray->ID ?>">
                                <input type="image" src="/ressources/addToCart.png">
                            </button>
                        </form>
                    </div>
                </div>
                <div>
                <p style="text-align: center; font-size: larger;text-decoration: underline;font-weight: bolder;">Ces articles pourraient vous intéresser:</p>
                        <div class="interestWrapper">
                            <?php 
                            $query = "SELECT * FROM `produit` WHERE Categorie = $dataArray->Categorie AND ID != $dataArray->ID ORDER BY rand();";
                            $runQuery = mysqli_query($connect, $query);
                                for ($i=0; $i < 5; $i++) { 
                                    $dataArray = mysqli_fetch_object($runQuery);
                                    ?>
                                        <a href="Produits.php?productItem=<?php echo $dataArray->ID ?>">
                                            <div class="interest">
                                                <div class="interestImage">
                                                    <div>
                                                        <?php
                                                        if($dataArray->Soldes != 0){
                                                            ?>
                                                                <img class="interestSoldePictureItemPage" src="/ressources/onSaleImage.png">     
                                                            <?php
                                                        }
                                                        ?>
                                                        <img class="interestProductImage" src="<?php echo $dataArray->Image ?>">
                                                    </div>
                                                </div>
                                                <div class="interestItemName">
                                                    <p style="color: black;text-decoration: underline;font-weight: bolder;"><?php echo $dataArray->Nom ?></p>
                                                </div>
                                                <?php
                                                    if($dataArray->Soldes != 0){
                                                        $discountedPrice = $dataArray->Prix - (($dataArray->Prix * $dataArray->Soldes) / 100);
                                                        ?>
                                                            <p style="color: black;">Prix: <strike><?php echo $dataArray->Prix ?>€</strike> -<?php echo $dataArray->Soldes."% => ". $discountedPrice ?>€</p>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                            <p style="color: black;">Prix: <?php echo $dataArray->Prix ?>€</p>
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                        </a>
                                    <?php 
                                }
                            ?>
                        </div>
                </div>
            <?php
        }
        else {
            $runQuery = mysqli_query($connect, $query);
            ?>
            <div class="productPanel">
            <?php
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
                            <div class="imageRelative">
                                <a Style="color: inherit;" href="Produits.php?productItem=<?php echo("$dataArray->ID")?>"><img class="itemPicture" src="<?php echo "$dataArray->Image" ?>"></a>
                                <?php
                                if ($_SESSION["isAdmin"] == "yes"){
                            ?>
                                <form action="GetItem.php" method="post" class="editItemForm">
                                    <input type="hidden" name="productID" value="<?php echo $dataArray->ID?>">
                                    <input type="image" src="/ressources/edit.png">
                                </form> 
                                <form action="DeleteItem.php" method="post" class="deleteItemForm">
                                    <input type="hidden" name="productID" value="<?php echo $dataArray->ID?>">
                                    <input type="image" src="/ressources/delete.png">
                                </form> 
                            <?php
                                }
                                if ($dataArray->Soldes != 0) { //Si il y a des soldes sur l'article
                                ?>
                                    <img class="soldePicture" src="/ressources/onSaleImage.png">
                                <?php
                                }
                                ?>
                            </div>
                            <div class="itemBottom">
                                <?php
                                    if ($dataArray->Soldes != 0) { //Si il y a des soldes sur l'article
                                        $discountedPrice = $dataArray->Prix - (($dataArray->Prix * $dataArray->Soldes) / 100);
                                    ?>
                                        <p> <?php echo "$dataArray->Nom<br> Prix: <strike>{$dataArray->Prix}€</strike> ${discountedPrice}€<br> En soldes -$dataArray->Soldes%" ?></p>
                                        <form method="post">
                                            <input type="image" class="addToCartImage" src="/ressources/addToCart.png">
                                            <input type="text" name="addToCart" value="<?php echo $dataArray->ID ?>" hidden readonly>
                                        </form>
                                    <?php
                                    } else {
                                    ?>
                                        <p><?php echo "$dataArray->Nom<br> Prix: {$dataArray->Prix}€" ?></p>
                                        <form method="post">
                                            <input type="image" class="addToCartImage" src="/ressources/addToCart.png">
                                            <input type="text" name="addToCart" value="<?php echo $dataArray->ID ?>" hidden readonly>
                                        </form>
                                    <?php
                                    }
                                ?>
                            </div>
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