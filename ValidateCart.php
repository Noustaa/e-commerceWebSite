<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ValidateCart.css?php echo time(); ?>">
    <link rel="stylesheet" href="Cart.css?php echo time(); ?>">
    <title>Valider le panier</title>
</head>
<body>
    <?php include "./NavMenu.php";

    if ($_SESSION["logged_in"] != "yes"){
        ?>
            <p style="margin-top: 30px;text-align: center;">Vous devez vous connecter pour valider un achat.</p>
            <p style="text-align: center;"><a href="Account.php">Connectez-vous</a> ou <a href="Register.php">enregistrez-vous.</a></p>
        <?php
        return;
    }

    include "./ValidateCartHeader.php";
    $connect = mysqli_connect("localhost", "u545314609_tanous", "f:0~*J5=Zo", "u545314609_eshop1");
    ?>
    <?php if (!$_POST || $_POST["queryOKAddAddress"]){
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
                            header("Location: Account.php");
                        }
                        ?>
                            <p>Vous n'avez pas encore enregistr?? d'adresse.</p>
                    <div style="position: relative; text-align:center;margin-top:20px;">
                    <H1>Enregistrer une nouvelle adresse:</H1>
                    <fieldset class="addNewAddress">
                        <legend>Ajouter une adresse</legend>
                        <form action="AddAddress.php" method="post">
                            <input type="hidden" name="ID" value="<?php echo $_SESSION["userid"] ?>">
                            <p>
                                <label for="numero">Numero de la rue: </label>
                                <input type="text" name="numero" id="numero" required>
                            </p>
                            <p>
                                <label for="rue">Rue: </label>
                                <input type="text" name="rue" id="rue" required>
                            </p>
                            <p>
                                <label for="codePostal">Code Postal: </label>
                                <input type="text" name="codePostal" id="codePostal" required>
                            </p>
                            <p>
                                <label for="ville">Ville: </label>
                                <input type="text" name="ville" id="ville" required>
                            </p>
                            <p>
                                <input type="submit" value="Valider">
                            </p>
                        </form>
                    </fieldset>
                    </div>
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
                            header("Location: Account.php");
                        }
                        ?>
                            <p>Vous n'avez pas encore enregistr?? de carte de paiement.</p>
                            <div style="position: relative; text-align:center;margin-top:20px;">
                            <H1>Enregistrer une nouvelle carte de paiement:</H1>
                            <fieldset class="addNewCard">
                                <legend>Ajouter une carte de paiement</legend>
                                <form action="AddCard.php" method="post">
                                    <input type="hidden" name="ID" value="<?php echo $_SESSION["userid"] ?>">
                                    <input type="hidden" name="selectedAddress" value="<?php echo $_POST["selectedAddress"] ?>">
                                    <p>
                                        <label for="titulaire">Nom et pr??nom: </label>
                                        <input type="text" name="titulaire" id="titulaire" required>
                                    </p>
                                    <p>
                                        <label for="numeroCarte">Num??ro de carte: </label>
                                        <input type="text" name="numeroCarte" id="numeroCarte" minlength="16" maxlength="16" required>
                                    </p>
                                    <p>
                                        <label for="cvv">Code de s??curit?? (CVV): </label>
                                        <input type="text" name="cvv" id="cvv" minlength="3" maxlength="3" required>
                                    </p>
                                    <p>
                                        <label for="expiryDate">Date d'expiration: </label>
                                        <input type="date" name="expiryDate" id="expiryDate" required>
                                    </p>
                                    <p>
                                        <input type="submit" value="Valider">
                                    </p>
                                </form>
                            </fieldset>
                            </div>
                        <?php
                    }
                ?>
        </div>
        <?php
    }
    elseif ($_POST["selectedAddressValidate"] && $_POST["selectedCard"]){
        if (!$_SESSION["addToCart"])
        {
            header("Location: Home.php");
            return;
        }
        ?>
        <div style="width: 30%" class="mainWrapper">
            <H1>Commande valid??e !</H1>
            <p>Nous vous remercions pour votre commande.</p>
            <p>Voici un r??capitulatif:</p>
        </div>
        <div class="recapWrapper">
            <div>
                <?php
                $totalPrice = 0;
                    if ($_SESSION["addToCart"]) {
                        $connect = mysqli_connect("localhost", "u545314609_tanous", "f:0~*J5=Zo", "u545314609_eshop1");
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
                        $commandSave = "";
                        foreach($_POST["setCartQty"] as $id => $qty){
                            $query = "SELECT * FROM `produit` WHERE ID = $id;";
                            $runQuery = mysqli_query($connect, $query);
                            $dataArray = mysqli_fetch_object($runQuery);
                            $commandSave .= "$id-$qty"
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
                                                $commandSave .= "-$discountedPrice/";
                                                ?>
                                                    <p> <?php echo "Prix: <strike>{$dataArray->Prix}???</strike> ${discountedPrice}???<br> En soldes -$dataArray->Soldes%" ?></p>
                                                <?php
                                            }
                                            else{
                                                $totalPrice += $qty * $dataArray->Prix;
                                                $commandSave .= "-$dataArray->Prix/";
                                                ?>
                                                    <p>Prix: <?php echo "{$dataArray->Prix}" ?>???</p>
                                                <?php
                                            }
                                            ?>
                                            <p style="display: inline-flexbox;">Quantit??: <?php echo $qty ?></p>
                                    </div>
                                    <hr class="lineSeparator" , size="1" , color=black>
                                </div>
                            <?php
                        }
                        $commandSave .= "$totalPrice";
                    ?>
                </div>
            <?php
            }
            ?>
            <div>
                <p style="margin: 0;">Vous serez livr?? ?? cette adresse:</p>
                <?php 
                    $query = "SELECT * FROM `userAddress` WHERE userid = ".$_SESSION["userid"].";";
                    $runQuery = mysqli_query($connect, $query);
                    for ($i=0; $i < $_POST["selectedAddressValidate"]; $i++) { 
                        $dataArray = mysqli_fetch_object($runQuery);
                    }
                    $query = "INSERT INTO `commandes` (`userid`, `date`, `contenu`, `numeroCommande`) VALUES ('".$_SESSION["userid"]."', '".date('Y-m-d')."', '".$commandSave."', NULL);";
                    $runQuery = mysqli_query($connect, $query);
                    $query = "SELECT numeroCommande FROM commandes ORDER BY numeroCommande DESC LIMIT 1;";
                    $runQuery = mysqli_query($connect, $query);
                    $commandNumber = mysqli_fetch_object($runQuery);
                ?>
                <div class="displayItemValidate">
                    <p>Rue: <?php echo "$dataArray->Numero, $dataArray->Rue" ?></p>
                    <p>Code postal: <?php echo $dataArray->CodePostal ?></p>
                    <p>Ville: <?php echo $dataArray->Ville ?></p>
                </div>
                <div class="recapPrice">
                    <p>Prix TTC: <?php echo $totalPrice ?>???</p>
                </div>
                <div>
                    <p>Num??ro de commande: <?php echo $commandNumber->numeroCommande ?></p>
                    <p>Vous pouvez consulter votre commande dans votre <a href="Account.php#commandHistory">historique de commandes.</a></p>
                    <p><a href="Home.php">Retourner ?? l'accueil.</a></p>
                </div>
            </div>      
        </div>
        <?php
        unset($_SESSION["addToCart"]);
    }
    else {
    }
    ?>
</body>
</html>