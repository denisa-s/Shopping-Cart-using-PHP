<?php
include("Conectare.php");
$error='';
if (isset($_POST['submit']))
{
// preluam datele de pe formular
    $nume = htmlentities($_POST['nume'], ENT_QUOTES);
    $pret = htmlentities($_POST['pret'], ENT_QUOTES);
    $imagine = htmlentities($_POST['imagine'], ENT_QUOTES);
    $categorie = htmlentities($_POST['categorie'], ENT_QUOTES);
    $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
    $desc_completa = htmlentities($_POST['desc_completa'], ENT_QUOTES);
    $stare = htmlentities($_POST['stare'], ENT_QUOTES);
    $oferta = htmlentities($_POST['oferta'], ENT_QUOTES);
    $noutati = htmlentities($_POST['noutati'], ENT_QUOTES);
    $cod = htmlentities($_POST['cod'], ENT_QUOTES);
    $metal = htmlentities($_POST['metal'], ENT_QUOTES);
    $piatra = htmlentities($_POST['piatra'], ENT_QUOTES);
// verificam daca sunt completate
    if ($nume == '' || $pret == ''|| $imagine==''|| $categorie==''|| $descriere==''||$desc_completa==''||
        $stare == '' || $oferta == ''|| $noutati==''|| $cod==''|| $metal==''||$piatra=='')
    {
// daca sunt goale se afiseaza un mesaj
        $error = 'ERROR: Campuri goale!';
    } else {
// insert
        if ($stmt = $mysqli->prepare("INSERT into produse (nume, pret, imagine, categorie, descriere, desc_completa,
                     stare, oferta, noutati, cod, metal, piatra) VALUES (?, ?, ?, ?, ?, ?,?,?,?,?,?,?)"))
        {
            $stmt->bind_param("sisssssiisss", $nume, $pret,$imagine,$categorie,$descriere,$desc_completa,$stare,
            $oferta,$noutati,$cod,$metal,$piatra);
            $stmt->execute();
            $stmt->close();
        }
// eroare le inserare
        else
        {
            echo "ERROR: Nu se poate executa insert.";
        }
    }
}
// se inchide conexiune mysqli
$mysqli->close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head> <title><?php echo "Inserare inregistrare"; ?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head> <body>
<h1><?php echo "Inserare inregistrare"; ?></h1>
<?php if ($error != '') {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
    <div>
        <strong>Nume: </strong> <input type="text" name="nume" value=""/><br/>
        <strong>Pret: </strong> <input type="text" name="pret" value=""/><br/>
        <strong>Imagine: </strong> <input type="text" name="imagine" value=""/><br/>
        <strong>Categorie: </strong> <input type="text" name="categorie" value=""/><br/>
        <strong>Descriere: </strong> <input type="text" name="descriere" value=""/><br/>
        <strong>Descriere completa: </strong> <input type="text" name="desc_completa" value=""/><br/>
        <strong>Stare: </strong> <input type="text" name="stare" value=""/><br/>
        <strong>Oferta: </strong> <input type="text" name="oferta" value=""/><br/>
        <strong>Noutati: </strong> <input type="text" name="noutati" value=""/><br/>
        <strong>Cod: </strong> <input type="text" name="cod" value=""/><br/>
        <strong>Metal: </strong> <input type="text" name="metal" value=""/><br/>
        <strong>Piatra: </strong> <input type="text" name="piatra" value=""/><br/>
        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="Vizualizare.php">Index</a>
    </div></form></body></html>