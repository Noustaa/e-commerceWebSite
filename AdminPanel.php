<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="AdminPanel.css?v=<?php echo time(); ?>">
    <title>Administration</title>
</head>
<body>
<?php include "./NavMenu.php";?>
    <?php 
        if ($_SESSION["logged_in"] == "yes"){
            if ($_SESSION["isAdmin"] == "yes"){
                ?>
                    <div style="position: relative; text-align:center;margin-top:20px;">
                        <fieldset class="editProduct">
                            <legend>Modifier un produit</legend>
                            <?php
                                if (!$_POST["Prix"] || $_POST["queryOK"] || $_POST["error"]) {
                                    if ($_POST["queryOK"]){
                                        ?>
                                            <p style="font-size: smaller;color:green; margin:0;margin-bottom:5px">Le produit a été correctement modifié.</p>
                                        <?php
                                    }
                                    if ($_POST["error"]){
                                        ?>
                                            <p style="font-size: smaller;color:red; margin:0;margin-bottom:5px">Erreur, le produit n'a pas été modifié.</p>
                                        <?php
                                    }
                                ?>
                                    <form action="GetItem.php" method="post">
                                        <p>
                                            <label for="productID">ID du produit: </label>
                                            <input type="text" name="productID" id="productID" required>
                                        </p>
                                        <p>
                                            <input type="submit" value="Modifier">
                                        </p>
                                    </form>
                                <?php
                            }
                            else {
                                ?>
                                    <form action="UpdateItem.php" method="post">
                                        <p>
                                            <label for="productID">ID du produit: </label>
                                            <input type="text" name="productID" id="productID" readonly>
                                        </p>
                                        <p>
                                            <label for="nom">Nom: </label>
                                            <input type="text" name="nom" id="nom" required>
                                        </p>
                                        <p>
                                            <label for="prix">Prix:(Euro) </label>
                                            <input type="text" name="prix" id="prix" required>
                                        </p>
                                        <p>
                                            <label for="soldes">Soldes:(%) </label>
                                            <input type="text" name="soldes" id="soldes" required>
                                        </p>
                                        <p>
                                            <label for="categorie">Categorie: </label>
                                            <input type="text" name="categorie" id="categorie" required>
                                        </p>
                                        <p>
                                            <label for="stock">Stock: </label>
                                            <input type="text" name="stock" id="stock" required>
                                        </p>
                                        <p>
                                            <label for="description">Description: </label>
                                            <textarea name="description" id="description" required></textarea>
                                        </p>
                                        <p>
                                            <label for="image">Image (url): </label>
                                            <textarea name="image" id="image" required></textarea>
                                        </p>
                                        <p>
                                            <a href="AdminPanel.php"><input type="button" value="Annuler"></a>
                                            <input type="submit" value="Valider">
                                        </p>
                                    </form>
                                    <script>
                                        document.getElementById("productID").value = "<?php echo $_POST['ID']?>";
                                        document.getElementById("nom").value = "<?php echo $_POST['Nom']?>";
                                        document.getElementById("prix").value = "<?php echo $_POST['Prix']?>";
                                        document.getElementById("soldes").value = "<?php echo $_POST['Soldes']?>";
                                        document.getElementById("categorie").value = "<?php echo $_POST['Categorie']?>";
                                        document.getElementById("stock").value = "<?php echo $_POST['Stock']?>";
                                        document.getElementById("description").value = "<?php echo $_POST['Description']?>";
                                        document.getElementById("image").value = "<?php echo $_POST['Image']?>";
                                    </script>
                                <?php
                            }
                            ?>
                        </fieldset>
                    </div>
                    <div style="position: relative; text-align:center;margin-top:20px;">
                        <fieldset class="deleteItem">
                            <legend>Supprimer un produit</legend>
                            <?php
                                if (isset($_POST["deleteQueryOK"])) {
                                        ?>
                                            <p style="font-size: smaller;color:green; margin:0;margin-bottom:5px">Le produit a été correctement supprimé.</p>
                                        <?php
                                    }
                            ?>
                            <form action="DeleteItem.php" method="post">
                                <p>
                                    <label for="productID">ID du produit: </label>
                                    <input type="text" name="productID" id="productIDDelete" required>
                                </p>
                                <p>
                                    <input type="submit" value="Supprimer" name="deleteItem" id="deleteItem">
                                </p>
                            </form>
                        </fieldset>
                    </div>
                    <script>
                        function checkCategorie() {
                            var categorie = document.getElementById('categorieAdd');
                            if (categorie.value < 1 || categorie.value > 5) {
                                categorie.setCustomValidity('Veuillez entrer une valeur comprise entre 1 et 5.');
                            } else {
                                // input is valid -- reset the error message
                                categorie.setCustomValidity('');
                            }
                        }
                    </script>
                    <div style="position: relative; text-align:center;margin-top:20px;">
                    <fieldset class="addItem">
                        <legend>Ajouter un produit</legend>
                        <?php
                            if (!$_POST["Prix"] || $_POST["queryOKAdd"] || $_POST["errorAddQuery"]) {
                                if ($_POST["queryOKAdd"]){
                                    ?>
                                        <p style="font-size: smaller;color:green; margin:0;margin-bottom:5px">Le produit a été correctement ajouté.</p>
                                    <?php
                                }
                                if ($_POST["errorAddQuery"]){
                                    ?>
                                        <p style="font-size: smaller;color:red; margin:0;margin-bottom:5px">Erreur, le produit n'a pas été ajouté.</p>
                                    <?php
                                }
                            }
                        ?>
                        <form action="AddItem.php" method="post">
                            <p>
                                <label for="nom">Nom: </label>
                                <input type="text" name="nom" id="nomAdd" required>
                            </p>
                            <p>
                                <label for="prix">Prix:(Euro) </label>
                                <input type="text" name="prix" id="prixAdd" required>
                            </p>
                            <p>
                                <label for="soldes">Soldes:(%) </label>
                                <input type="text" name="soldes" id="soldesAdd" required>
                            </p>
                            <p>
                                <label for="categorie">Categorie: </label>
                                <input type="text" name="categorie" id="categorieAdd" onkeyup="checkCategorie()" required>
                            </p>
                            <p>
                                <label for="stock">Stock: </label>
                                <input type="text" name="stock" id="stockAdd" required>
                            </p>
                            <p>
                                <label for="description">Description: </label>
                                <textarea name="description" id="descriptionAdd" required></textarea>
                            </p>
                            <p>
                                <label for="image">Image (url): </label>
                                <textarea name="image" id="imageAdd" required></textarea>
                            </p>
                            <p>
                                <input type="submit" value="Valider">
                            </p>
                        </form>
                        <script>
                            document.getElementById("nomAdd").value = "<?php echo $_POST['NomAdd']?>";
                            document.getElementById("prixAdd").value = "<?php echo $_POST['PrixAdd']?>";
                            document.getElementById("soldesAdd").value = "<?php echo $_POST['SoldesAdd']?>";
                            document.getElementById("categorieAdd").value = "<?php echo $_POST['CategorieAdd']?>";
                            document.getElementById("stockAdd").value = "<?php echo $_POST['StockAdd']?>";
                            document.getElementById("descriptionAdd").value = "<?php echo $_POST['DescriptionAdd']?>";
                            document.getElementById("imageAdd").value = "<?php echo $_POST['ImageAdd']?>";
                        </script>
                    </fieldset>
                    </div>

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

                    <div style="position: relative; text-align:center;margin-top:20px;">
                    <fieldset class="addAdmin">
                        <legend>Ajouter un administrateur</legend>
                        <a name="addAdmin"></a>
                        <?php
                            if (isset($_POST["registerQueryOK"])){
                                ?>
                                    <p style="font-size: smaller;color:green; margin:0;margin-bottom:5px">Le compte administrateur a bien été créé.</p>
                                <?php
                            }
                            if (isset($_POST["registerQueryError"])){
                                ?>
                                    <p style="font-size: smaller;color:red; margin:0;margin-bottom:5px">Ce nom d'utilisateur est déjà pris. Le compte n'a pas été créé.</p>
                                <?php
                            }
                        ?>
                        <form action="AddUser.php" method="post">
                        <p>
                            <label for="username">Nom d'utilisateur:</label>
                            <input type="text" name="username" id="username" required>
                        </p>
                        <p>
                            <label for="password">Mot de passe:</label>
                            <input type="password" name="password1" id="password1" onkeyup="checkPasswordsMatchs()" required>
                        </p>
                        <p>
                            <label for="rePassword">Confirmer le mot de passe:</label>
                            <input type="password" name="password2" id="password2" onkeyup="checkPasswordsMatchs()" required>
                        </p>
                        <p>
                            <label for="firstName">Prénom:</label>
                            <input type="text" name="firstName" id="firstName" required>
                        </p>
                        <p>
                            <label for="lastName">Nom:</label>
                            <input type="text" name="lastName" id="lastName" required>
                        </p>
                        <p>
                            <label for="email">Adresse email:</label>
                            <input type="text" name="email" id="email" required>
                        </p>
                        <p>
                            <label for="birthdate">Date de naissance: </label>
                            <input type="date" name="birthdate" id="birthdate">
                        </p>
                        <p>
                            <label for="sexe">Genre: </label>
                            <span class="radioSexe">
                                <input type="radio" id="sexeM" name="sexe" value="M">
                                <label for="sexeM" style="font-size: smaller;">Masculin</label>
                                <input type="radio" id="sexeF" name="sexe" value="F">
                                <label for="sexeF" style="font-size: smaller;">Féminin</label>
                                <input type="radio" id="sexeN" name="sexe" value="N" checked hidden>
                            </span>
                        </p>
                        <p>
                            <input type="hidden" name="role" value="administrator">
                            <input type="submit" value="Valider">
                        </p>
                        </form>
                    </fieldset>
                    </div>
                    <?php 
                        if (isset($_POST["registerQueryError"]))
                        {
                            ?>
                                <script>
                                    document.getElementById("username").value = "<?php echo $_POST['username']?>";
                                    document.getElementById("firstName").value = "<?php echo $_POST['firstName']?>";
                                    document.getElementById("lastName").value = "<?php echo $_POST['lastName']?>";
                                    document.getElementById("email").value = "<?php echo $_POST['email']?>";
                                </script>
                            <?php
                        }
            }
            else {
                echo "You do not have privilege to see this page.";
            }
        }
        else {
            echo "You do not have privilege to see this page.";
        }
    ?>
</body>
</html>