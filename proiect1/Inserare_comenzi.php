<?php
include("Conectare.php");
$error='';
if (isset($_POST['submit']))
{
// preluam datele de pe formular
    $total = htmlentities($_POST['total'], ENT_QUOTES);
    $clientID = htmlentities($_POST['clientID'], ENT_QUOTES);
    $data_introducerii = htmlentities($_POST['dataintroducerii'], ENT_QUOTES);
    $stare_comanda = htmlentities($_POST['stare_comanda'], ENT_QUOTES);
// verificam daca sunt completate
    if ($total == '' || $clientID == ''|| $data_introducerii==''|| $stare_comanda=='')
    {
// daca sunt goale se afiseaza un mesaj
        $error = 'ERROR: Campuri goale!';
    } else {
// insert
        if ($stmt = $mysqli->prepare("INSERT into comanda (total, clientID, dataintroducerii, stare_comanda) VALUES (?, ?,?,?)"))
        {
            $stmt->bind_param("iiss", $total, $clientID,$data_introducerii,$stare_comanda);
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
        <strong>Total: </strong> <input type="text" name="total" value=""/><br/>
        <strong>Client ID: </strong> <input type="text" name="clientID" value=""/><br/>
        <strong>Data introducerii: </strong> <input type="text" name="dataintroducerii" value=""/><br/>
        <strong>Stare comanda: </strong> <input type="text" name="stare_comanda" value=""/><br/>
        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="Vizualizare_comenzi.php">Index</a>
    </div></form></body></html>