<?php
session_start();
if ($_SESSION['addToCart'])
{
    $addToCart = $_SESSION['addToCart'];
}
session_unset();
session_destroy();
session_start();
$_SESSION['addToCart'] = $addToCart;
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>