<?php

$connect = mysqli_connect("localhost", "u545314609_tanous", "f:0~*J5=Zo", "u545314609_eshop1");
    if ($_POST){
        $id = $_POST['ID'];
        $titulaire = $_POST['titulaire'];
        $numeroCarte = str_replace(' ', '', $_POST['numeroCarte']);
        $numeroCarte1 = substr($_POST['numeroCarte'], 0, 4);
        $numeroCarte2 = substr($_POST['numeroCarte'], 4, 4);
        $numeroCarte3 = substr($_POST['numeroCarte'], 8, 4);
        $numeroCarte4 = substr($_POST['numeroCarte'], 12, 4);
        $cvv = $_POST['cvv'];
        $expiryDate = $_POST['expiryDate'];
        $query = "INSERT INTO `creditCards` (`userid`, `expiryDate`, `cvv`, `titulaire`, `cardNumber1`, `cardNumber2`, `cardNumber3`, `cardNumber4`) VALUES ('".$id."', '".$expiryDate."', '".$cvv."', '".$titulaire."', '".$numeroCarte1."', '".$numeroCarte2."', '".$numeroCarte3."', '".$numeroCarte4."');";
        $runQuery = mysqli_query($connect, $query);
        if ($runQuery != false){
            ?>
            <form action="ValidateCart.php" method="post" id="sendBack">
                <input type="hidden" name="queryOKAddCard" value="OK">
                <input type="hidden" name="selectedAddress" value="<?php echo $_POST["selectedAddress"] ?>">
            </form> 
            <script>
                document.getElementById('sendBack').submit();
            </script>
        <?php
        }
        else {
            ?>
            <form action="ValidateCart.php" method="post" id="sendBack">
                <input type="hidden" name="errorAddCard" value="error">
            </form> 
            <script>
                document.getElementById('sendBack').submit();
            </script>
        <?php
        }
    }

?>