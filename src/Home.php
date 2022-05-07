<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- force CSS to reload to avoid cache issue -->
    <link rel="stylesheet" href="/src/Style.css?v=<?php echo time(); ?>">
    <title>Home</title>
</head>

<body>
<?php include "./NavMenu.php" ?>

    <div id="slideshow">
        <ul id="sContent">
            <li><img src="https://us.123rf.com/450wm/sabelskaya/sabelskaya1603/sabelskaya160300156/54119905-carr%C3%A9-neon-lumi%C3%A8re-bleue-au-n%C3%A9on-.jpg?ver=6" alt="Image bleue" /></li>
            <li><img src="https://us.123rf.com/450wm/sabelskaya/sabelskaya1603/sabelskaya160300156/54119905-carr%C3%A9-neon-lumi%C3%A8re-bleue-au-n%C3%A9on-.jpg?ver=6" alt="Image verte" /></li>
            <li><img src="https://us.123rf.com/450wm/sabelskaya/sabelskaya1603/sabelskaya160300156/54119905-carr%C3%A9-neon-lumi%C3%A8re-bleue-au-n%C3%A9on-.jpg?ver=6" alt="Image brune" /></li>
        </ul>
    </div>

    <hr style="width:40%" , size="1" , color=black>


    <div>
        <?php
        $connect = mysqli_connect("localhost", "noustaa", "ssss");
        mysqli_select_db($connect, "dev");
        $query = "SELECT ID, Nom, Image, Soldes, Prix FROM produit;";
        $runQuery = mysqli_query($connect, $query);


        while (true) {
        ?>
            <div class="itemsRow">
                <?php
                for ($i = 0; $i < 4; $i++) { //To allow only 4 items per row
                ?>
                    <div class="item">
                        <?php
                        if (($dataArray = mysqli_fetch_object($runQuery)) == NULL) {
                            break;
                        }
                        ?>
                        <img class="itemPicture" src="<?php echo "$dataArray->Image" ?>">
                        <?php
                        if ($dataArray->Soldes != 0) { //Si il y a des soldes sur l'article
                            $discountedPrice = $dataArray->Prix - (($dataArray->Prix * $dataArray->Soldes) / 100);
                        ?>
                            <img class="soldePicture" src="../ressources/onSaleImage.png">
                            <p> <?php echo "$dataArray->Nom<br> Prix: <strike>{$dataArray->Prix}€</strike> ${discountedPrice}€<br> En soldes -$dataArray->Soldes%" ?></p>
                        <?php
                        } else {
                        ?>
                            <p><?php echo "$dataArray->Nom<br> Prix: {$dataArray->Prix}€" ?></p>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php

            if ($dataArray == NULL) {
                break;
            }
        }
        ?>
    </div>
</body>

</html>