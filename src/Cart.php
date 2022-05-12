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
    function updateQTY(qty, id){
        document.getElementById("qty"+id).value = qty;
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
        while (isset($_SESSION["addToCart"][array_search($_POST["deleteFromCart"], $_SESSION["addToCart"])])) {
            unset($_SESSION["addToCart"][array_search($_POST["deleteFromCart"], $_SESSION["addToCart"])]);
        }
    }
    include "./NavMenu.php"; ?>
    <div class="itemDiv">
        <H1>Mon panier</H1>
        <div class="lineWrapper">
            <?php 
                if ($_POST["qtyChange"]){
                    $counter = 0;
                    foreach ($_SESSION["addToCart"] as $id){
                        if ($id == $_POST["qtyChange"]){
                            $counter += 1;
                        }
                    }
                    if ($counter > $_POST["qty"]){
                        unset($_SESSION["addToCart"][array_search($_POST["qtyChange"], $_SESSION["addToCart"])]);
                    }
                    elseif ($counter < $_POST["qty"])
                    {
                        array_push($_SESSION["addToCart"], $_POST["qtyChange"]);
                    }
                }
                if ($_SESSION["addToCart"]) {
                    $connect = mysqli_connect("localhost", "noustaa", "ssss", "dev");
                    $counter = 0;
                    foreach ($_SESSION["addToCart"] as $item) {
                        $query = "SELECT * FROM `produit` WHERE ID = $item;";
                        $runQuery = mysqli_query($connect, $query);
                        $dataArray = mysqli_fetch_object($runQuery);
                        if (!isset($_POST["setCartQty"][$dataArray->ID])){
                            $_POST["setCartQty"][$dataArray->ID] = 1;
                        }
                        else{
                            $_POST["setCartQty"][$dataArray->ID] += 1;
                        }
                        ?>
                        <script>
                            addToPrice(<?php echo $counter ?>, <?php echo $dataArray->Prix ?>);
                        </script>
                        <?php
                        $counter++;
                    }
                    foreach($_POST["setCartQty"] as $id => $qty){
                        $query = "SELECT * FROM `produit` WHERE ID = $id;";
                        $runQuery = mysqli_query($connect, $query);
                        $dataArray = mysqli_fetch_object($runQuery);
                        ?>
                            <div class="itemLine">
                                <div class="imageWrapper">
                                    <img src="<?php echo $dataArray->Image ?>">
                                </div>
                                <div class="textWrapper">
                                    <p><?php echo "$dataArray->Nom" ?> </p>
                                    <p>Prix: <?php echo "{$dataArray->Prix}" ?>€</p>
                                    <form method="post">
                                    <p style="display: inline-flexbox;">Quantité: <input  onchange="resetIndex(<?php echo $counter ?>);addToPrice(<?php echo $counter ?>, this.value * <?php echo $dataArray->Prix ?>); updatePrice(); updateQTY(this.value, <?php echo $id ?>);submit();" style="width: 40px;" type="number" value="<?php echo $qty ?>" min="1" max="99"></p>
                                        <input type="text" name="qtyChange" value="<?php echo $id ?>" hidden readonly>
                                        <input type="text" name="qty" id="qty<?php echo $id ?>" value="" hidden readonly>
                                    </form>
                                    <p>
                                        <form method="post">
                                            <button name="deleteFromCart" value="<?php echo $dataArray->ID ?>" type="submit">Suppimer du panier</button>
                                        </form>
                                    </p>
                                </div>
                                <hr class="lineSeparator" , size="1" , color=black>
                            </div>
                        <?php
                    }
                ?>
            </div>

            <div class="detailsDiv"> 
                <p style="float: left;margin-right: 150px;" id="totalPrice"></p>
                <script>updatePrice()</script>
                <form action="">
                    <input style="margin-top:13px" type="submit" value="Valider votre panier">
                </form>
            </div>
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