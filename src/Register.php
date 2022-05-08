<script>
    function toggleDisplayDiv()
    {
        var loginPopup = document.getElementById("loginPopup");
        if (loginPopup.style.display == "none"){
            loginPopup.style.display = "block";
        }
        else{
            loginPopup.style.display = "none";
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
    <?php include "./NavMenu.php"?>
    <div class="registerForm">
        <fieldset>
            <legend>Inscription</legend>
                <form method="post">
                    <p>
                        <label for="firstName">Prénom: </label>
                        <input type="text" id="firstName">
                    </p>
                    <p>
                        <label for="lastName">Nom: </label>
                        <input type="text" id="lastName">
                    </p>
                    <p>
                        <label for="email">Adresse email: </label>
                        <input type="text" id="email">
                    </p>
                    <p>
                        <label for="birthdate">Date de naissance: </label>
                        <input type="date" id="birthdate">
                    </p>
                    <p>
                        <label for="sexe">Sexe: </label>
                        <span class="radioSexe">
                            <input type="radio" id="sexeM" name="sexe" value="M">
                            <label for="sexeM">Masculin</label>
                            <input type="radio" id="sexeF" name="sexe" value="F">
                            <label for="sexeF">Féminin</label>
                        </span>
                    </p>
                    <p>
                        <input type="submit" value="Valider l'inscription">
                    </p>
                </form>
        </fieldset>
    </div>
</body>
</html>