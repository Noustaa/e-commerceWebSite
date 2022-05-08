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
            <form name="Form" action="Connect.php" method="POST">
                <label for="user">Identifiant:</label>
                <input type="text" id="user" name="user" />
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" />
                <button type="submit">Connexion</button>
            </form>
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
                // print_r($_POST);
                // print_r($_SESSION);
                if ($_POST["editUsername"]) {
                ?>
                    <form method="post">
                        <p>Votre nom d'utilisateur: <input type="text" name="modifiedUsername" value="<?php echo $_SESSION["username"] ?>" style="width: 30%;text-align: center;">
                            <input type="submit" class="validateUsername" name="validateUsername" value="Valider" />
                        </p>
                    </form>
                    <?php
                } elseif ($_POST["validateUsername"]) {
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
                <p>Votre mot de passe: ********</p>
                <form method="post">
                    <input type="submit" class="editPassword" name="editPassword" value="Modifier" />
                </form>
            </div>
            <br>
            <br>
            <form action="Logout.php">
                <button type="submit" style="margin-bottom: 10px;">Se déconnecter</button>
            </form>
        </div>
    <?php
    }
    ?>
</body>

</html>