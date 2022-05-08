<?php session_start(); ?>

<script>
    var price = [];
    function resetIndex(index) {
        price[index] = 0;
    }
    function updatePrice(){
        totalPrice = price.reduce((a, b) => a + b, 0); //to add all array values together
        document.getElementById("totalPrice").innerHTML = "Total TTC: "+totalPrice+"€";
    }
    function addToPrice(index, number){
        price[index] = number;
    }
</script>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Cart.css?v=<?php echo time(); ?>">
    <title>Mon Panier</title>
</head>
<body>
    <?php
    if ($_POST["deleteFromCart"]) {
        unset($_SESSION["addToCart"][array_search($_POST["deleteFromCart"], $_SESSION["addToCart"])]);
    }
    include "./NavMenu.php"; ?>
    <div>
        <H1>Mon panier</H1>
        <?php 
            if ($_SESSION["addToCart"]) {
                $connect = mysqli_connect("localhost", "noustaa", "ssss", "dev");
                $counter = 0;
                foreach ($_SESSION["addToCart"] as $item) {
                    $query = "SELECT * FROM `produit` WHERE ID = $item;";
                    $runQuery = mysqli_query($connect, $query);
                    $dataArray = mysqli_fetch_object($runQuery);
                    ?>
                    <script>
                        addToPrice(<?php echo $counter ?>, <?php echo $dataArray->Prix ?>);
                    </script>
                        <div class="itemLine">
                            <img style="width: 100px;float: left;" src="<?php echo $dataArray->Image ?>">
                            <p><?php echo "$dataArray->Nom <br> Prix: {$dataArray->Prix}€ <br>Quantité:" ?><input onchange="resetIndex(<?php echo $counter ?>);addToPrice(<?php echo $counter ?>, this.value * <?php echo $dataArray->Prix ?>); updatePrice();" style="width: 40px;" type="number" value="1" min="1" max="99"></p>
                            <form method="post">
                                <button name="deleteFromCart" value="<?php echo $dataArray->ID ?>" type="submit">Suppimer du panier</button>
                            </form>
                        </div>
                        <br>
                        <hr style="width:50%;float: left;" , size="1" , color=black>
                        <br>
                    <?php
                    $counter++;
                }
            ?>
            <p style="float: left;margin-right: 150px;" id="totalPrice"></p>
            <script>updatePrice()</script>
            <form action="">
                <input style="margin-top:13px" type="submit" value="Valider votre panier">
            </form>
        <?php
            }
            else {
                ?>
                    <p>Votre panier est vide.</p>
                <?php
            }
            ?>
    </div>
</body>
</html>