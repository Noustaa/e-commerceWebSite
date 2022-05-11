<?php
$connect = mysqli_connect("localhost", "noustaa", "ssss", "dev");
if ($_POST){
    $productID = $_POST["productID"];
    $query = "SELECT * FROM `produit` WHERE id = ".$productID.";";
    $runQuery = mysqli_query($connect, $query);
    $dataArray = mysqli_fetch_object($runQuery);
    if ($runQuery != false) {
        ?>
            <form action="AdminPanel.php" method="post" id="sendBack">
                <input type="hidden" name="ID" value="<?php echo $dataArray->ID?>">
                <input type="hidden" name="Nom" value="<?php echo $dataArray->Nom?>">
                <input type="hidden" name="Image" value="<?php echo $dataArray->Image?>">
                <input type="hidden" name="Soldes" value="<?php echo $dataArray->Soldes?>">
                <input type="hidden" name="Prix" value="<?php echo $dataArray->Prix?>">
                <input type="hidden" name="Categorie" value="<?php echo $dataArray->Categorie?>">
                <input type="hidden" name="Stock" value="<?php echo $dataArray->Stock?>">
                <input type="hidden" name="Description" value="<?php echo $dataArray->Description?>">
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