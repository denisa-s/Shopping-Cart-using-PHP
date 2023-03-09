<?php // connectare bazadedate
include("Conectare.php");
//Modificare datelor
// se preia id din pagina vizualizare
$error='';
if (!empty($_POST['id']))
{ if (isset($_POST['submit']))
{ // verificam daca id-ul din URL este unul valid
    if (is_numeric($_POST['id']))
    { // preluam variabilele din URL/form
        $id = $_POST['id'];
        $nume = htmlentities($_POST['nume'], ENT_QUOTES);
        $imagine = htmlentities($_POST['imagine'], ENT_QUOTES);
        $desc_completa = htmlentities($_POST['desc_completa'], ENT_QUOTES);
    }
    else
    {echo "id incorect!";} }}?>
<html>
<head>
    <title> <?php if ($_GET['id'] != '') { echo "Detalii produs"; }?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8"/></head>
<body>
<h1><?php $id= '';
    if ($_GET['id'] != '') { echo "Detalii produs"; }?></h1>
<?php if ($error != '') {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
    <div>
        <?php if ($_GET['id'] != '') { ?>
        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
        <p>ID: <?php echo $_GET['id'];
            if ($result = $mysqli->query("SELECT * FROM produse where produsid='".$_GET['id']."'"))
            {
            if ($result->num_rows > 0)
            { $row = $result->fetch_object();?></p>
        <strong>Nume: <strong> <?php echo$row->nume; ?></strong><br/>
            <strong>Descriere completa: <strong> <?php echo$row->desc_completa; ?></strong><br/>
        </strong> <input type="image" name="imagine" src="<?php echo$row->imagine;  }}}?>"/><br/>
        <br/>
        <a href="magazin.php">Inapoi</a>
    </div></form></body> </html>
