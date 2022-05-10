<?php

use PhpMyAdmin\Console;

$username = $_POST['username'];
$password = $_POST['password1'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$sexe = $_POST["sexe"];
if ($_POST['birthdate'] != ""){
    $birthdate = $_POST['birthdate'];
}
else{
    $birthdate = "0000-00-00";
}

$connect = mysqli_connect("localhost", "noustaa", "ssss", "dev");
$query = "INSERT INTO `users` (`userid`, `username`, `password`, `prenom`, `nom`, `mail`, `birthdate`, `sexe`) VALUES (NULL, '$username', '$password', '$firstName', '$lastName', '$email', '$birthdate', '$sexe');";
$runQuery = mysqli_query($connect, $query);

if ($runQuery){

}
else {
    ?>
        <form action="Register.php?registeringError" method="post" id="sendBack">
            <input type="hidden" name="postBack[username]" value="<?php echo $_POST["username"]?>">
            <input type="hidden" name="postBack[password1]" value="<?php echo $_POST["password1"]?>">
            <input type="hidden" name="postBack[firstName]" value="<?php echo $_POST["firstName"]?>">
            <input type="hidden" name="postBack[lastName]" value="<?php echo $_POST["lastName"]?>">
            <input type="hidden" name="postBack[email]" value="<?php echo $_POST["email"]?>">
            <input type="hidden" name="postBack[sexe]" value="<?php echo $_POST["sexe"]?>">
            <input type="hidden" name="postBack[birthdate]" value="<?php echo $_POST["birthdate"]?>">
        </form>
        <script>
            document.getElementById('sendBack').submit();
        </script>
    <?php
    return mysqli_error($connect);
}
?>