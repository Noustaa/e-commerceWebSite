<?php

$connect = mysqli_connect("localhost", "noustaa", "ssss", "u545314609_eshop1");
    if ($_POST){
        $id = $_POST['ID'];
        $numero = $_POST['numero'];
        $rue = str_replace("'", "''", $_POST['rue']);
        $codePostal = $_POST['codePostal'];
        $ville = $_POST['ville'];
        $query = "INSERT INTO `userAddress` (`userid`, `Numero`, `Rue`, `CodePostal`, `Ville`) VALUES ('".$id."', '".$numero."', '".$rue."', '".$codePostal."', '".$ville."');";
        $runQuery = mysqli_query($connect, $query);
        if ($runQuery != false){
            ?>
            <form action="ValidateCart.php" method="post" id="sendBack">
                <input type="hidden" name="queryOKAddAddress" value="OK">
            </form> 
            <script>
                document.getElementById('sendBack').submit();
            </script>
        <?php
        }
        else {
            ?>
            <form action="ValidateCart.php" method="post" id="sendBack">
                <input type="hidden" name="errorAddAddress" value="error">
            </form> 
            <script>
                document.getElementById('sendBack').submit();
            </script>
        <?php
        }
    }

?>