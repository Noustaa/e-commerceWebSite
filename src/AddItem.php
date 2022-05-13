<?php

$connect = mysqli_connect("localhost", "noustaa", "ssss", "dev");
    if ($_POST){
        $nom = $_POST["nom"];
        $prix = $_POST["prix"];
        $soldes = $_POST["soldes"];
        $categorie = $_POST["categorie"];
        $stock = $_POST["stock"];
        $description = $_POST["description"];
        $image = $_POST["image"];
        $query = "INSERT INTO `produit` (`ID`, `Nom`, `Image`, `Soldes`, `Prix`, `Categorie`, `Stock`, `Description`) VALUES (NULL, '".$nom."', '".$image."', '".$soldes."', '".$prix."', '".$categorie."', '".$stock."', '".$description."');";
        $runQuery = mysqli_query($connect, $query);
        if ($runQuery != false){
            ?>
            <form action="AdminPanel.php" method="post" id="sendBack">
                <input type="hidden" name="queryOKAdd" value="OK">
            </form> 
            <script>
                document.getElementById('sendBack').submit();
            </script>
        <?php
        }
        else {
            ?>
            <form action="AdminPanel.php" method="post" id="sendBack">
                <input type="hidden" name="NomAdd" value="<?php echo $nom?>">
                <input type="hidden" name="ImageAdd" value="<?php echo $image?>">
                <input type="hidden" name="SoldesAdd" value="<?php echo $soldes?>">
                <input type="hidden" name="PrixAdd" value="<?php echo $prix?>">
                <input type="hidden" name="CategorieAdd" value="<?php echo $categorie?>">
                <input type="hidden" name="StockAdd" value="<?php echo $stock?>">
                <input type="hidden" name="DescriptionAdd" value="<?php echo $description?>">
                <input type="hidden" name="errorAddQuery" value="error">
            </form> 
            <script>
                document.getElementById('sendBack').submit();
            </script>
        <?php
        }
    }

?>