<?php
$connect = mysqli_connect("localhost", "noustaa", "ssss", "u545314609_eshop1");
if ($_POST){
    $productID = $_POST["productID"];
    $query = "DELETE FROM `produit` WHERE `produit`.`ID` = ".$productID.";";
    $runQuery = mysqli_query($connect, $query);
    $dataArray = mysqli_fetch_object($runQuery);
    if ($runQuery != false) {
        ?>
            <form action="AdminPanel.php" method="post" id="sendBack">
                <input type="hidden" name="deleteQueryOK">
            </form> 
            <script>
                document.getElementById('sendBack').submit();
            </script>
        <?php
    }
    else {
        echo mysqli_error($connect);
    }
}
?>