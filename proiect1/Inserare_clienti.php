<?php
include("Conectare.php");
$error='';
if (isset($_POST['submit']))
{
// preluam datele de pe formular
    $username = htmlentities($_POST['username'], ENT_QUOTES);
    $password = htmlentities($_POST['password'], ENT_QUOTES);
    $email = htmlentities($_POST['email'], ENT_QUOTES);
    $strada = htmlentities($_POST['strada'], ENT_QUOTES);
    $oras = htmlentities($_POST['oras'], ENT_QUOTES);
    $tara = htmlentities($_POST['tara'], ENT_QUOTES);
    $codpostal = htmlentities($_POST['codpostal'], ENT_QUOTES);
    $nrcard = htmlentities($_POST['nrcard'], ENT_QUOTES);
    $tipcard = htmlentities($_POST['tipcard'], ENT_QUOTES);
    $dataexpcard = htmlentities($_POST['dataexpcard'], ENT_QUOTES);
    $nrinregRC = htmlentities($_POST['nrinregRC'], ENT_QUOTES);
    $nume = htmlentities($_POST['nume'], ENT_QUOTES);
    $codfiscal = htmlentities($_POST['codfiscal'], ENT_QUOTES);
// verificam daca sunt completate
    if ($username == '' || $password == ''|| $email==''|| $strada==''|| $oras==''||$tara==''||
        $codpostal == '' || $nrcard == ''|| $tipcard==''|| $dataexpcard==''|| $nrinregRC==''||$nume==''||$codfiscal=='')
    {
// daca sunt goale se afiseaza un mesaj
        $error = 'ERROR: Campuri goale!';
    } else {
// insert
        if ($stmt = $mysqli->prepare("INSERT into clienti (username, password, email, strada, oras, tara,
                     codpostal, nrcard, tipcard, dataexpcard, acceptareemail, nrinregRC, nume,codfiscal) VALUES (?, ?, ?, ?, ?, ?,?,?,?,?,1,?,?,?)"))
        {
            $stmt->bind_param("ssssssiissisi", $username, $password,$email,$strada,$oras,$tara,$codpostal,
                $nrcard,$tipcard,$dataexpcard,$nrinregRC,$nume,$codfiscal);
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
        <strong>Username: </strong> <input type="text" name="username" value=""/><br/>
        <strong>Parola: </strong> <input type="text" name="password" value=""/><br/>
        <strong>Email: </strong> <input type="text" name="email" value=""/><br/>
        <strong>Strada: </strong> <input type="text" name="strada" value=""/><br/>
        <strong>Oras: </strong> <input type="text" name="oras" value=""/><br/>
        <strong>Tara: </strong> <input type="text" name="tara" value=""/><br/>
        <strong>Cod postal: </strong> <input type="text" name="codpostal" value=""/><br/>
        <strong>Numar card: </strong> <input type="text" name="nrcard" value=""/><br/>
        <strong>Tip card: </strong> <input type="text" name="tipcard" value=""/><br/>
        <strong>Data expirare card: </strong> <input type="text" name="dataexpcard" value=""/><br/>
        <strong>Numar inreg RC: </strong> <input type="text" name="nrinregRC" value=""/><br/>
        <strong>Nume: </strong> <input type="text" name="nume" value=""/><br/>
        <strong>Cod fiscal: </strong> <input type="text" name="codfiscal" value=""/><br/>
        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="Vizualizare_clienti.php">Index</a>
    </div></form></body></html>
