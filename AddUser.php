<?php

$username = $_POST['username'];
$password = $_POST['password1'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$sexe = $_POST["sexe"];
$role = $_POST["role"];
if ($_POST['birthdate'] != ""){
    $birthdate = $_POST['birthdate'];
}
else{
    $birthdate = "0000-00-00";
}

$connect = mysqli_connect("localhost", "u545314609_tanous", "f:0~*J5=Zo", "u545314609_eshop1");
$query = "INSERT INTO `users` (`userid`, `username`, `password`, `prenom`, `nom`, `mail`, `birthdate`, `sexe`, `role`) VALUES (NULL, '$username', '$password', '$firstName', '$lastName', '$email', '$birthdate', '$sexe', '$role');";
$runQuery = mysqli_query($connect, $query);

if ($runQuery){
    if ($role == "user") {
        ?>
            <form action="Account.php" method="post" id="sendBack">
                <input type="hidden" name="registerQueryOK">
            </form>
            <script>
                document.getElementById('sendBack').submit();
            </script>
        <?php
    }
    else{
        ?>
        <form action="AdminPanel.php#addAdmin" method="post" id="sendBack">
            <input type="hidden" name="registerQueryOK">
        </form>
        <script>
            document.getElementById('sendBack').submit();
        </script>
    <?php
    }
}
else {
    if ($role == "user") {
    ?>
        <form action="Register.php" method="post" id="sendBack">
            <input type="hidden" name="registerQueryError">
            <input type="hidden" name="username" value="<?php echo $_POST["username"]?>">
            <input type="hidden" name="firstName" value="<?php echo $_POST["firstName"]?>">
            <input type="hidden" name="lastName" value="<?php echo $_POST["lastName"]?>">
            <input type="hidden" name="email" value="<?php echo $_POST["email"]?>">
        </form>
        <script>
            document.getElementById('sendBack').submit();
        </script>
    <?php
    }
    else{
    ?>
        <form action="AdminPanel.php#addAdmin" method="post" id="sendBack">
            <input type="hidden" name="registerQueryError">
            <input type="hidden" name="username" value="<?php echo $_POST["username"]?>">
            <input type="hidden" name="firstName" value="<?php echo $_POST["firstName"]?>">
            <input type="hidden" name="lastName" value="<?php echo $_POST["lastName"]?>">
            <input type="hidden" name="email" value="<?php echo $_POST["email"]?>">
        </form>
        <script>
            document.getElementById('sendBack').submit();
        </script>
    <?php
    }
}
?>