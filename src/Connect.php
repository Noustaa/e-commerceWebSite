<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/src/Style.css?v=<?php echo time(); ?>">
    </head>
    <body>
        <?php
            $n = "$_POST[user]";
            $p = "$_POST[password]";
            $connect = mysqli_connect("localhost", "noustaa", "ssss", "u545314609_eshop1");
            $query = "SELECT * FROM users;";
            $runQuery = mysqli_query($connect, $query);
            while (($dataArray = mysqli_fetch_object($runQuery)) != null){
                if ($dataArray->username == "$n" && $dataArray->password == "$p") {
                    $_SESSION["session_id"] = session_id();
                    $_SESSION["username"]=$dataArray->username;
                    $_SESSION["userid"]=$dataArray->userid;
                    $_SESSION["prenom"]=$dataArray->prenom;
                    $_SESSION["nom"]=$dataArray->nom;
                    $_SESSION["email"]=$dataArray->mail;
                    $_SESSION["birthdate"]=$dataArray->birthdate;
                    $_SESSION["sexe"]=$dataArray->sexe;
                    $_SESSION["logged_in"] = "yes";
                    if ($dataArray->role == "administrator"){
                        $_SESSION["isAdmin"]="yes"; 
                    }
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    return;
                }
            }
                echo "Utilisateur ou mot de passe incorrect.<br>";
        ?>
                <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Retourner a la page précédente.</a>
    </body>
</html>