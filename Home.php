<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1920, initial-scale=1.0">
    <!-- force CSS to reload to avoid cache issue -->
    <link rel="stylesheet" href="Style.css?v=<?php echo time(); ?>">
    <title>Home</title>
</head>
<body>
    <div>
        <hr style="width:100%", size="6", color=black>  
        <h1 style="text-align:center">E-Shop</h1>
        <hr style="width:50%", size="3", color=black>  
        <h1 style="text-align:center">By Tanous & Salim</h1>
        <hr style="width:100%", size="6", color=black> 
    </div>
    <nav style="text-align: center;">
        <div>
            <ul class="delPuces menuButtonStyle">
                <a href="Home.php"><li>Accueil</li></a>
                <a href=""><li>Produits</li></a>
                <a href=""><li>A propos</li></a>
                <a href=""><li>Mon compte</li></a>
            </ul>
        </div>
    </nav>
    <hr style="width:40%", size="1", color=black>  

    <div id="slideshow">
    	<ul id="sContent">
            <li><img src="https://us.123rf.com/450wm/sabelskaya/sabelskaya1603/sabelskaya160300156/54119905-carr%C3%A9-neon-lumi%C3%A8re-bleue-au-n%C3%A9on-.jpg?ver=6" alt="Image bleue" /></li>
            <li><img src="https://us.123rf.com/450wm/sabelskaya/sabelskaya1603/sabelskaya160300156/54119905-carr%C3%A9-neon-lumi%C3%A8re-bleue-au-n%C3%A9on-.jpg?ver=6" alt="Image verte" /></li>
            <li><img src="https://us.123rf.com/450wm/sabelskaya/sabelskaya1603/sabelskaya160300156/54119905-carr%C3%A9-neon-lumi%C3%A8re-bleue-au-n%C3%A9on-.jpg?ver=6" alt="Image brune" /></li>
	    </ul>
    </div>

    <hr style="width:40%", size="1", color=black>  


    <div  class="itemsGrid" style="text-align: center;">
        <div class="test" style="display: inline-block;">
            <?php
                $connect = mysqli_connect("localhost", "noustaa", "ssss");
                mysqli_select_db($connect, "dev");
                $query = "SELECT ID, Nom, Image, Soldes, Prix FROM produit;";
                $runQuery = mysqli_query($connect, $query);
                while (true) {
                    echo "<div>";
                    echo "<div style='display:inline-flex;'>";
                    for ($i=0; $i < 4; $i++) { 
                        if (($dataArray = mysqli_fetch_object($runQuery)) == NULL) {
                            break;
                        }
                        echo "<div class='test2'>";
                        echo "<img src='$dataArray->Image'>";
                        if ($dataArray->Soldes != 0) { //Si il y a des soldes sur l'article
                            $discountedPrice = $dataArray->Prix - (($dataArray->Prix*$dataArray->Soldes)/100);
                            echo "<p>$dataArray->Nom<br> Prix: <strike>{$dataArray->Prix}€</strike> ${discountedPrice}€<br> En soldes -$dataArray->Soldes%</p>";
                        }
                        else{
                            echo "<p>$dataArray->Nom<br> Prix: {$dataArray->Prix}€</p>";
                        }
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "</div>";
                    if ($dataArray == NULL) {
                        break;
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>