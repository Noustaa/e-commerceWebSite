<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
<?php include "./NavMenu.php"?>

    <div class="mainWrapper">
        <div class="firstSlideDiv">
            <a href="Produits.php?categorie=Bonnets"><img src="/ressources/slideBonnets.jpg">
            <h1>Découvrez notre selection de bonnets</h1></a>
        </div>
        <div class="secondSlideDivWrapper">
            <div class="secondSlideDiv">
                <a href="Produits.php?categorie=Manteaux"><img src="/ressources/slideManteaux.jfif">
                <h1>Découvrez notre selection de manteaux</h1></a>
            </div>
        </div>
        <div class="thirdSlideDiv">
            <a href="Produits.php?categorie=Baskets"><img src="/ressources/slideBaskets.jpg">
            <h1>Découvrez notre selection de chaussures</h1></a>
        </div>
    </div>    

</body> 
</html>