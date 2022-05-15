<?php
    $connect = mysqli_connect("localhost", "u545314609_tanous", "f:0~*J5=Zo", "u545314609_eshop1");
    if ($_POST){
        $productID = $_POST["productID"];
        $nom = $_POST["nom"];
        $prix = $_POST["prix"];
        $soldes = $_POST["soldes"];
        $categorie = $_POST["categorie"];
        $stock = $_POST["stock"];
        $description = $_POST["description"];
        $image = $_POST["image"];
        $query = "UPDATE `produit` SET `Nom` = '".$nom."', `Soldes` = '".$soldes."', `Prix` = '".$prix."', `Categorie` = '".$categorie."', `Stock` = '".$stock."', `Description` = '".$description."', `Image` = '".$image."' WHERE `produit`.`ID` = ".$productID.";";
        $runQuery = mysqli_query($connect, $query);
        if ($runQuery != false){
            ?>
            <form action="AdminPanel.php" method="post" id="sendBack">
                <input type="hidden" name="queryOK" value="OK">
            </form> 
            <script>
                document.getElementById('sendBack').submit();
            </script>
        <?php
        }
        else {
            ?>
            <form action="AdminPanel.php" method="post" id="sendBack">
                <input type="hidden" name="error" value="error">
            </form> 
            <script>
                document.getElementById('sendBack').submit();
            </script>
        <?php
        }
    }
?>