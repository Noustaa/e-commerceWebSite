<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php
            $n = "$_POST[user]";
            $p = "$_POST[password]";
            $connect = mysqli_connect("localhost", "noustaa", "ssss", "dev");
            $query = "SELECT username, password, userid FROM admins;";
            $runQuery = mysqli_query($connect, $query);
            $dataArray = mysqli_fetch_row($runQuery);
            if ($dataArray[0] == "$n" && $dataArray[1] == "$p") {
                $_SESSION["session_id"] = session_id();
                $_SESSION["username"]=$dataArray[0];
                $_SESSION["userid"]=$dataArray[2];
                $_SESSION["isAdmin"]="yes";
                $_SESSION["logged_in"] = "yes";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
            else{
                $query = "SELECT username, password, userid FROM users;";
                $runQuery = mysqli_query($connect, $query);
                $dataArray = mysqli_fetch_row($runQuery);
                if ($dataArray[0] == "$n" && $dataArray[1] == "$p") {
                    $_SESSION["session_id"] = session_id();
                    $_SESSION["username"]=$dataArray[0];
                    $_SESSION["userid"]=$dataArray[2];
                    $_SESSION["logged_in"] = "yes";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
                else {
                    echo "Connection Failed";
                }
            }
        ?>
    </body>
</html>