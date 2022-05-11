<script>
    function checkPasswordsMatchs() {
        var password1 = document.getElementById('password1');
        var password2 = document.getElementById('password2');
        if (password1.value != password2.value) {
            password2.setCustomValidity('Les mots de passe saisis ne sont pas identiques.');
        } else {
            // input is valid -- reset the error message
            password2.setCustomValidity('');
        }
    }
</script>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/Register.css?v=<?php echo time(); ?>">
    <title>Register</title>
</head>

<body>
    <?php include "./NavMenu.php";
    if ($_POST)
    {
        print_r($_POST);
        echo $_POST['username'];
    } ?>


    <div class="registerForm">
        <fieldset>
            <legend>Inscription</legend>
            <span class="whitePanel"></span>
            <form action="RegisterUser.php" method="post">
                <p>
                    <label for="username">Nom d'utilisateur:<span style="color: red;">*</span></label>
                    <input type="text" name="username" id="username" required>
                </p>
                <p>
                    <label for="password">Mot de passe:<span style="color: red;">*</span> </label>
                    <input type="password" name="password1" id="password1" onkeyup="checkPasswordsMatchs()" required>
                </p>
                <p>
                    <label for="rePassword">Confirmer le mot de passe:<span style="color: red;">*</span> </label>
                    <input type="password" name="password2" id="password2" onkeyup="checkPasswordsMatchs()" required>
                </p>
                <p>
                    <label for="firstName">Prénom:<span style="color: red;">*</span> </label>
                    <input type="text" name="firstName" id="firstName" required>
                </p>
                <p>
                    <label for="lastName">Nom:<span style="color: red;">*</span> </label>
                    <input type="text" name="lastName" id="lastName" required>
                </p>
                <p>
                    <label for="email">Adresse email:<span style="color: red;">*</span> </label>
                    <input type="text" name="email" id="email" required>
                </p>
                <p>
                    <label for="birthdate">Date de naissance: </label>
                    <input type="date" name="birthdate" id="birthdate">
                </p>
                <p>
                    <label for="sexe">Sexe: </label>
                    <span class="radioSexe">
                        <input type="radio" id="sexeM" name="sexe" value="M">
                        <label for="sexeM">Masculin</label>
                        <input type="radio" id="sexeF" name="sexe" value="F">
                        <label for="sexeF">Féminin</label>
                        <input type="radio" id="sexeN" name="sexe" value="N" default hidden>
                    </span>
                </p>
                <p>
                    <input type="submit" value="Valider l'inscription">
                </p>
            </form>
        </fieldset>
    </div>
    <script>
        document.getElementById("firstName").value = "<?php echo $_POST['username']?>";
    </script>
</body>

</html>