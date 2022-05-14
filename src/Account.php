<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Account.css?v=<?php echo time(); ?>">
    <title>Account</title>
</head>

<body>
    <title>Account</title>

    <?php include "./NavMenu.php" ?>

    <?php
    if ($_SESSION["logged_in"] != "yes") {
    ?>
        <div class="loginDiv">
            <?php
                if (isset($_POST["registerQueryOK"])){
                    ?>
                        <p style="font-size: smaller;color:green; margin:0;margin-bottom:5px">Votre compte a bien été créé.<br>Vous pouvez désormais vous connecter.</p>
                    <?php
                }
            ?>
            <form name="Form" action="Connect.php" method="POST">
                <label for="user">Identifiant:</label>
                <input type="text" id="user" name="user" />
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" />
                <button type="submit">Connexion</button>
            </form>
            <a style="display:block;margin-top:20px" href="/src/Register.php">Pas encore de compte ? Enregistrez vous.</a>
        </div>
    <?php
    } else {
    ?>
        <div class="myAccount">
            <p>Bienvenue, <?php echo $_SESSION["username"] ?>.</p>
            <hr style="width:10%" , size="2" , color=black>
            <br>
            <div class="usernameDetails">
                <?php
                if ($_POST["editUsername"]) {
                ?>
                    <form method="post">
                        <p>Votre nom d'utilisateur: <input type="text" name="modifiedUsername" value="<?php echo $_SESSION["username"] ?>" style="width: 30%;text-align: center;">
                            <input type="submit" class="validateUsername" name="validateUsername" value="Valider">
                        </p>
                    </form>
                    <?php
                } 
                elseif ($_POST["validateUsername"]) {
                    if (mysqli_query(mysqli_connect("localhost", "noustaa", "ssss", "dev"), "UPDATE `users` SET `username` = '" . $_POST["modifiedUsername"] . "' WHERE `users`.`userid` = " . $_SESSION["userid"] . ";")) {
                        $_SESSION["username"] = $_POST["modifiedUsername"];
                    ?>
                        <p style="color: green;font-size: smaller;">Le nom d'utilisteur à bien été modifié.</p>
                        <p>Votre nom d'utilisateur: <?php echo $_SESSION["username"] ?></p>
                        <form method="post">
                            <input type="submit" class="editUsername" name="editUsername" value="Modifier" />
                        </form>
                    <?php
                    } else {
                    ?>
                        <p style="color: red;font-size: smaller;">Une erreur est survenue. Le nom d'utilisateur n'a pas été modifié.</p>
                        <p>Votre nom d'utilisateur: <?php echo $_SESSION["username"] ?></p>
                        <form method="post">
                            <input type="submit" class="editUsername" name="editUsername" value="Modifier" />
                        </form>
                    <?php
                    }
                } else {
                    ?>
                    <p>Votre nom d'utilisateur: <?php echo $_SESSION["username"] ?></p>
                    <form method="post">
                        <input type="submit" class="editUsername" name="editUsername" value="Modifier" />
                    </form>
                <?php
                }
                ?>
            </div>
            <br><br><br>
            <div class="passwordDetails">
            <?php
                if ($_POST["editPassword"]){
                    ?>
                        <form method="post">
                            <p>Mot de passe actuel: <input type="password" name="currentPassword" style="width: 30%;text-align: center;"></p>
                            <p>Nouveau mot de passe: <input type="password" name="newPassword1" style="width: 30%;text-align: center;"></p>
                            <p>Nouveau mot de passe: <input type="password" name="newPassword2" style="width: 30%;text-align: center;"></p>
                                <input type="submit" class="validatePassword" name="validatePassword" value="Valider">
                            </p>
                        </form>
                    <?php
                }
                elseif ($_POST["validatePassword"])
                {
                    $n = $_SESSION["username"];
                    $p = $_POST["currentPassword"];
                    $connect = mysqli_connect("localhost", "noustaa", "ssss", "u545314609_eshop1");
                    $query = "SELECT username, password, userid FROM users WHERE `users`.`userid` = ".$_SESSION["userid"].";";
                    $runQuery = mysqli_query($connect, $query);
                    $dataArray = mysqli_fetch_row($runQuery);
                    if ($dataArray[0] == "$n" && $dataArray[1] == "$p") {
                        if ($_POST["newPassword1"] == $_POST["newPassword2"]){
                            $query = "UPDATE `users` SET `password` = '".$_POST["newPassword1"]."' WHERE userid = ".$_SESSION["userid"].";";
                            $runQuery = mysqli_query($connect, $query);
                            if ($runQuery != false) {
                                ?>
                                    <p style="color: green;font-size: smaller;">Mot de passe modifié avec succès.</p>
                                <?php 
                            }
                            else{
                                ?>
                                    <p style="color: red;font-size: smaller;">Une erreur est survenue. Le mot de passe n'a pas été modifié.</p>
                                <?php 
                            }
                            ?>
                                <p>Votre mot de passe: ********</p>
                                <form method="post">
                                    <input type="submit" class="editPassword" name="editPassword" value="Modifier" />
                                </form>
                            <?php
                        }
                        else{
                            ?>
                                <form method="post">
                                    <p style="color: red;font-size: smaller;">Les mots de passe saisis ne sont pas identiques.</p>
                                    <p>Mot de passe actuel: <input type="password" name="currentPassword" style="width: 30%;text-align: center;"></p>
                                    <p>Nouveau mot de passe: <input type="password" name="newPassword1" style="width: 30%;text-align: center;"></p>
                                    <p>Nouveau mot de passe: <input type="password" name="newPassword2" style="width: 30%;text-align: center;"></p>
                                        <input type="submit" class="validatePassword" name="validatePassword" value="Valider">
                                    </p>
                                </form>
                            <?php
                        }
                    }
                    else{
                        ?>
                            <form method="post">
                                <p style="color: red;font-size: smaller;">Votre mot de passe est incorrect.</p>
                                <p>Mot de passe actuel: <input type="password" name="currentPassword" style="width: 30%;text-align: center;"></p>
                                <p>Nouveau mot de passe: <input type="password" name="newPassword1" style="width: 30%;text-align: center;"></p>
                                <p>Nouveau mot de passe: <input type="password" name="newPassword2" style="width: 30%;text-align: center;"></p>
                                    <input type="submit" class="validatePassword" name="validatePassword" value="Valider">
                                </p>
                            </form>
                        <?php
                    }
                }
                else
                {
                    ?>
                        <p>Votre mot de passe: ********</p>
                        <form method="post">
                            <input type="submit" class="editPassword" name="editPassword" value="Modifier" />
                        </form>
                    <?php
                }
                ?>
            </div>
            <br>
            <div class="accountDetails">
                <p>Prénom: <?php echo $_SESSION["prenom"] ?></p>
                <p>Nom: <?php echo $_SESSION["nom"] ?></p>
                <p>E-mail: <?php echo $_SESSION["email"] ?></p>
                <p>Date de naissance: <?php if ($_SESSION["birthdate"] == "0000-00-00"){ echo "Non renseignée";}else{ echo $_SESSION["birthdate"];} ?></p>
                <p>Genre: <?php if ($_SESSION["sexe"] == "N"){ echo "Non renseigné";}else{ echo $_SESSION["sexe"];}?></p>
            </div>
            <br>
            <br>
            <form action="Logout.php">
                <button type="submit" style="margin-bottom: 10px;">Se déconnecter</button>
            </form>
        </div>
        <?php
            $connect = mysqli_connect("localhost", "noustaa", "ssss", "u545314609_eshop1");
            $query = "SELECT * FROM `commandes` where userid=".$_SESSION["userid"].";";
            $runQueryCommands = mysqli_query($connect, $query);
        ?>
        <div class="commandHistoryWrapper">
            <fieldset>
                <legend>Historique des commandes</legend>
                <div class="globalCommandHistory">
                    <?php 
                    while (($dataArray = mysqli_fetch_object($runQueryCommands)) != null) {
                        $commandContent = $dataArray->contenu;
                        $numeroCommande = $dataArray->numeroCommande;
                        $date = $dataArray->date;
                        $contentArray = explode("/", $commandContent);
                        $prix = $contentArray[count($contentArray)-1];
                        $singleContentArray = array();
                        foreach ($contentArray as $value) {
                            array_push($singleContentArray, explode("-", $value));
                        }
                        unset($singleContentArray[count($singleContentArray)-1]);
                        ?>
                    <div class="singleCommandHistory">
                        <div class="itemsWrapper">
                        <?php 
                        foreach ($singleContentArray as $value) {
                            ?> <div class="singleCommandHistoryRow"> <?php
                            $query = "SELECT * FROM `produit` where ID=".$value[0].";";
                            $runQuery = mysqli_query($connect, $query);
                            $dataArray = mysqli_fetch_object($runQuery);
                            ?>
                            <a href="/src/Produits.php?productItem=<?php echo $dataArray->ID ?>"><img src="<?php echo $dataArray->Image ?>"></a>
                            <p>Prix: <?php echo $value[2]."€<br>Quantité: ". $value[1] ?></p>
                            </div>
                            <?php
                        }
                        ?>
                        </div>
                        <div class="detailsWrapper">
                        <p>Numero de commande: <?php echo $numeroCommande ?></p>
                        <p>Date de la commande: <?php echo $date ?></p>
                        <p>Prix TTC: <?php echo $prix ?>€</p>
                        </div>
                    </div>
                    <?php
                    } 
                    ?>
                </div>
                <a name="commandHistory"></a>
            </fieldset>
        </div>
    <?php
    }
    ?>
</body>
</html>