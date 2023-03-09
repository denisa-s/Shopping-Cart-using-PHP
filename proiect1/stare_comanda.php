<?php
session_start();
include("Conectare.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Stare comanda:</title>
    <link rel="stylesheet"
          href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body>
<div>
    <h1>Stare comanda</h1>
    <p><b>Comanda a fost plasata! Va multumim.</b</p>
    <div><a id="btnEmpty" href="cos.php?action=empty">Incepe o noua sesiune de cumparaturi</a></div>
</div>
</body>
</html>