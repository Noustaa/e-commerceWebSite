<link rel="stylesheet" href="ValidateCartHeader.css?v=<?php echo time(); ?>">

<H1 style="margin-bottom: 40px; text-align: center;">Valider votre panier</H1>
<div class="hrWrapper">
    <div>
        <span style="background-color: #383838;"></span>
        <p>LIVRAISON</p>
    </div>
    <?php
        if ($_POST["selectedAddress"] || $_POST["selectedCard"]){
            ?>
                <hr style="border-color: black;" id="step2">
                <div>
                    <span style="background-color: #383838;" id="dot2"></span>
                    <p style="color: #383838;">PAIEMENT</p>
                </div>
            <?php
        }
        else{
            ?>
                <hr style="border-color: #D0D0D0;" id="step2">
                <div>
                    <span style="background-color: #D0D0D0;" id="dot2"></span>
                    <p style="color: #D0D0D0;">PAIEMENT</p>
                </div>
            <?php
        }
        if ($_POST["selectedAddressValidate"] && $_POST["selectedCard"]){
            ?>
                <hr style="border-color: black;" id="step3">
                <div>
                    <span style="background-color: #383838;" id="dot3"></span>
                    <p style="color: #383838;">CONFIRMATION</p>
                </div>
            <?php
        }
        else{
            ?>
                <hr style="border-color: #D0D0D0;" id="step3">
                <div>
                    <span style="background-color: #D0D0D0;" id="dot3"></span>
                    <p style="color: #D0D0D0;">CONFIRMATION</p>
                </div>
            <?php
        }
    ?>
</div>
