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
                                            <input type="text" name="productID" id="productID">
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
                                            <input type="text" name="nom" id="nom">
                                        </p>
                                        <p>
                                            <label for="prix">Prix:(Euro) </label>
                                            <input type="text" name="prix" id="prix">
                                        </p>
                                        <p>
                                            <label for="soldes">Soldes:(%) </label>
                                            <input type="text" name="soldes" id="soldes">
                                        </p>
                                        <p>
                                            <label for="categorie">Categorie: </label>
                                            <input type="text" name="categorie" id="categorie">
                                        </p>
                                        <p>
                                            <label for="stock">Stock: </label>
                                            <input type="text" name="stock" id="stock">
                                        </p>
                                        <p>
                                            <label for="description">Description: </label>
                                            <textarea name="description" id="description"></textarea>
                                        </p>
                                        <p>
                                            <label for="image">Image: </label>
                                            <textarea name="image" id="image"></textarea>
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
                                    <input type="text" name="productID" id="productIDDelete">
                                </p>
                                <p>
                                    <input type="submit" value="Supprimer" name="deleteItem" id="deleteItem">
                                </p>
                            </form>
                        </fieldset>
                    </div>
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
                                <input type="text" name="nom" id="nomAdd">
                            </p>
                            <p>
                                <label for="prix">Prix:(Euro) </label>
                                <input type="text" name="prix" id="prixAdd">
                            </p>
                            <p>
                                <label for="soldes">Soldes:(%) </label>
                                <input type="text" name="soldes" id="soldesAdd">
                            </p>
                            <p>
                                <label for="categorie">Categorie: </label>
                                <input type="text" name="categorie" id="categorieAdd">
                            </p>
                            <p>
                                <label for="stock">Stock: </label>
                                <input type="text" name="stock" id="stockAdd">
                            </p>
                            <p>
                                <label for="description">Description: </label>
                                <textarea name="description" id="descriptionAdd"></textarea>
                            </p>
                            <p>
                                <label for="image">Image (url): </label>
                                <textarea name="image" id="imageAdd"></textarea>
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
                <?php
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