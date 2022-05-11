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
            $connect = mysqli_connect("localhost", "noustaa", "ssss", "dev");
            $query = "SELECT username, password, userid FROM admins;";
            $runQuery = mysqli_query($connect, $query);
            while (($dataArray = mysqli_fetch_row($runQuery)) != null){
                if ($dataArray[0] == "$n" && $dataArray[1] == "$p") {
                    $_SESSION["session_id"] = session_id();
                    $_SESSION["username"]=$dataArray[0];
                    $_SESSION["userid"]=$dataArray[2];
                    $_SESSION["isAdmin"]="yes";
                    $_SESSION["logged_in"] = "yes";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    return;
                }
            }            
            $query = "SELECT * FROM users;";
            $runQuery = mysqli_query($connect, $query);
            while (($dataArray = mysqli_fetch_row($runQuery)) != null){
                if ($dataArray[1] == "$n" && $dataArray[2] == "$p") {
                    $_SESSION["session_id"] = session_id();
                    $_SESSION["username"]=$dataArray[1];
                    $_SESSION["userid"]=$dataArray[0];
                    $_SESSION["prenom"]=$dataArray[3];
                    $_SESSION["nom"]=$dataArray[4];
                    $_SESSION["email"]=$dataArray[5];
                    $_SESSION["birthdate"]=$dataArray[6];
                    $_SESSION["sexe"]=$dataArray[7];
                    $_SESSION["logged_in"] = "yes";
                    print_r($dataArray);
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    return;
                }
            }
                echo "Utilisateur ou mot de passe incorrect.<br>";
        ?>
                <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Retourner a la page précédente.</a>
    </body>
</html>