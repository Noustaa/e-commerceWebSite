<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/ValidateCart.css?php echo time(); ?>">
    <link rel="stylesheet" href="/src/Cart.css?php echo time(); ?>">
    <title>Valider le panier</title>
</head>
<body>
    <?php include "./NavMenu.php";
    include "./ValidateCartHeader.php";
    $connect = mysqli_connect("localhost", "noustaa", "ssss", "dev");
    ?>
    <?php if (!$_POST){
        ?>
            <div class="mainWrapper">
                <H1>Adresse de livraison:</H1>
                <?php
                    $query = "SELECT * FROM `userAddress` WHERE userid = ".$_SESSION["userid"].";";
                    $runQuery = mysqli_query($connect, $query);
                    if (mysqli_affected_rows($connect) > 0){
                        ?> 
                        <p>Veuillez selectionner une addresse de livraison:</p>
                        <div class="secondWrapper">
                        <div class="displayItemWrapper">
                        <?php
                        $valueCounter = 1;
                        while (($dataArray = mysqli_fetch_object($runQuery)) != null)
                        {                 
                        ?>
                            <input type="radio" name="selectedItem" value="<?php echo $valueCounter ?>" id="<?php echo $valueCounter ?>" hidden>
                            <label class="radioValidator" for="<?php echo $valueCounter ?>">
                            <div class="displayItem">
                                <p>Rue: <?php echo "$dataArray->Numero, $dataArray->Rue" ?></p>
                                <p>Code postal: <?php echo $dataArray->CodePostal ?></p>
                                <p>Ville: <?php echo $dataArray->Ville ?></p>
                            </div>
                            </label>
                        <?php
                        $valueCounter += 1;
                        }
                        ?> </div> <?php
                        ?>
                            <form class="formValidate" method="post" onsubmit="return returnSelectedAddress()">
                                <input type="text" name="selectedAddress" id="selectedAddress" hidden readonly>
                                <input type="submit" value="Valider">
                            </form>
                            <script>
                                function returnSelectedAddress(){
                                    if (document.querySelector('input[name="selectedItem"]:checked')){
                                        document.getElementById("selectedAddress").value = document.querySelector('input[name="selectedItem"]:checked').value;
                                    }
                                    else{
                                        return false;
                                    }
                                }
                            </script>
                        </div>
                        <?php
                    }
                    else{
                        if(!$_SESSION["logged_in"]){
                            header("Location: /src/Account.php");
                        }
                        ?>
                            <p>Vous n'avez pas encore enregistré d'adresse.</p>
                        <?php
                    }
                ?>
            </div>
            <?php
    }
    elseif($_POST["selectedAddress"]){
        ?>
        <div class="mainWrapper">
            <H1>Selection du moyen de paiment:</H1>
            <?php
                    $query = "SELECT * FROM `creditCards` WHERE userid = ".$_SESSION["userid"].";";
                    $runQuery = mysqli_query($connect, $query);
                    if (mysqli_affected_rows($connect) > 0){
                        ?> 
                        <p>Veuillez selectionner une carte de paiement:</p>
                        <div class="secondWrapper">
                        <div class="displayItemWrapper">
                        <?php
                        $valueCounter = 1;
                        while (($dataArray = mysqli_fetch_object($runQuery)) != null)
                        {                 
                        ?>
                            <input type="radio" name="selectedItem" value="<?php echo $valueCounter ?>" id="<?php echo $valueCounter ?>" hidden>
                            <label class="radioValidator" for="<?php echo $valueCounter ?>">
                            <div class="displayItem">
                                <p>Titulaire de la carte: <?php echo $dataArray->titulaire ?></p>
                                <p>Numero de la carte: <?php echo "$dataArray->cardNumber1-****-****-****" ?></p>
                                <p>CVV: ***</p>
                                <p>Date d'expiration: <?php echo $dataArray->expiryDate ?></p>
                            </div>
                            </label>
                        <?php
                        $valueCounter += 1;
                        }
                        ?> </div> <?php
                        ?>
                            <form class="formValidate" method="post" onsubmit="return returnSelectedCard()">
                                <input type="text" name="selectedCard" id="selectedCard" hidden readonly>
                                <input type="text" name="selectedAddressValidate" id="selectedAddressValidate" value="<?php echo $_POST["selectedAddress"] ?>" hidden readonly>
                                <input type="submit" value="Valider">
                            </form>
                            <script>
                                function returnSelectedCard(){
                                    if (document.querySelector('input[name="selectedItem"]:checked')){
                                        document.getElementById("selectedCard").value = document.querySelector('input[name="selectedItem"]:checked').value;
                                    }
                                    else{
                                        return false;
                                    }
                                }
                            </script>
                        </div>
                        <?php
                    }
                    else{
                        if(!$_SESSION["logged_in"]){
                            header("Location: /src/Account.php");
                        }
                        ?>
                            <p>Vous n'avez pas encore enregistré de carte de paiement.</p>
                        <?php
                    }
                ?>
        </div>
        <?php
    }
    elseif ($_POST["selectedAddressValidate"] && $_POST["selectedCard"]){
        ?>
        <div class="mainWrapper">
            <H1>Commande validé !</H1>
            <p>Nous vous remercions pour votre commande.</p>
            <p>Voici un récapitulatif:</p>
        </div>
        <div class="recapWrapper">
            <div>
                <?php
                $totalPrice = 0;
                    if ($_SESSION["addToCart"]) {
                        $connect = mysqli_connect("localhost", "noustaa", "ssss", "dev");
                        foreach ($_SESSION["addToCart"] as $item) {
                            $query = "SELECT * FROM `produit` WHERE ID = $item;";
                            $runQuery = mysqli_query($connect, $query);
                            $dataArray = mysqli_fetch_object($runQuery);
                            if (!isset($_POST["setCartQty"][$dataArray->ID])){
                                $_POST["setCartQty"][$dataArray->ID] = 1;
                            }
                            else{
                                $_POST["setCartQty"][$dataArray->ID] += 1;
                            }
                        }
                        foreach($_POST["setCartQty"] as $id => $qty){
                            $query = "SELECT * FROM `produit` WHERE ID = $id;";
                            $runQuery = mysqli_query($connect, $query);
                            $dataArray = mysqli_fetch_object($runQuery);
                            ?>
                                <div class="itemLine">
                                    <div class="imageWrapper">
                                        <img src="<?php echo $dataArray->Image ?>">
                                    </div>
                                    <div class="textWrapper">
                                        <p><?php echo "$dataArray->Nom" ?> </p>
                                        <?php 
                                            if($dataArray->Soldes != 0)
                                            {
                                                $discountedPrice = $dataArray->Prix - (($dataArray->Prix * $dataArray->Soldes) / 100);
                                                $totalPrice += $qty * $discountedPrice;
                                                ?>
                                                    <p> <?php echo "Prix: <strike>{$dataArray->Prix}€</strike> ${discountedPrice}€<br> En soldes -$dataArray->Soldes%" ?></p>
                                                <?php
                                            }
                                            else{
                                                $totalPrice += $qty * $dataArray->Prix;
                                                ?>
                                                    <p>Prix: <?php echo "{$dataArray->Prix}" ?>€</p>
                                                <?php
                                            }
                                            ?>
                                            <p style="display: inline-flexbox;">Quantité: <?php echo $qty ?></p>
                                    </div>
                                    <hr class="lineSeparator" , size="1" , color=black>
                                </div>
                            <?php
                        }
                    ?>
                </div>
            <?php
            }
            ?>
            <div>
                <p style="margin: 0;">Vous serez livré à cette adresse:</p>
                <?php 
                    $query = "SELECT * FROM `userAddress` WHERE userid = ".$_SESSION["userid"].";";
                    $runQuery = mysqli_query($connect, $query);
                    for ($i=0; $i < $_POST["selectedAddressValidate"]; $i++) { 
                        $dataArray = mysqli_fetch_object($runQuery);
                    }
                ?>
                <div class="displayItemValidate">
                    <p>Rue: <?php echo "$dataArray->Numero, $dataArray->Rue" ?></p>
                    <p>Code postal: <?php echo $dataArray->CodePostal ?></p>
                    <p>Ville: <?php echo $dataArray->Ville ?></p>
                </div>
                <div class="recapPrice">
                    <p>Prix TTC: <?php echo $totalPrice ?>€</p>
                </div>
            </div>      
        </div>
        <?php
    }
    ?>
</body>
</html>