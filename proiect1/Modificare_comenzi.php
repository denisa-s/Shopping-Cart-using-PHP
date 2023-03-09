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
        $total = htmlentities($_POST['total'], ENT_QUOTES);
        $clientID = htmlentities($_POST['clientID'], ENT_QUOTES);
        $data_introducerii = htmlentities($_POST['dataintroducerii'], ENT_QUOTES);
        $stare_comanda = htmlentities($_POST['stare_comanda'], ENT_QUOTES);
// verificam daca nu sunt goale
        if ($total == '' || $clientID == ''|| $data_introducerii==''|| $stare_comanda=='')
        { // daca sunt goale afisam mesaj de eroare
            echo "<div> ERROR: Completati campurile obligatorii!</div>";
        }
        else
        { // daca nu sunt erori se face update
            if ($stmt = $mysqli->prepare("UPDATE comanda SET total=?,clientID=?,dataintroducerii=?,stare_comanda=?
               WHERE id='".$id."'"))
            {
                $stmt->bind_param("iiss", $total, $clientID,$data_introducerii,$stare_comanda);
                $stmt->execute();
                $stmt->close();
            }// mesaj de eroare in caz ca nu se poate face update
            else
            {echo "ERROR: nu se poate executa update.";}
        }
    }
// daca variabila 'id' nu este valida, afisam mesaj de
    else
    {echo "id incorect!";} }}?>
<html> <head><title> <?php if ($_GET['id'] != '') { echo "Modificare inregistrare"; }?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8"/></head>
<body>
<h1><?php $id= '';
    if ($_GET['id'] != '') { echo "Modificare Inregistrare"; }?></h1>
<?php if ($error != '') {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
    <div>
        <?php if ($_GET['id'] != '') { ?>
        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
        <p>ID: <?php echo $_GET['id'];
            if ($result = $mysqli->query("SELECT * FROM comanda where id='".$_GET['id']."'"))
            {
            if ($result->num_rows > 0)
            { $row = $result->fetch_object();?>
        </p>
        <strong>Total: </strong> <input type="text" name="total" value="<?php echo$row->total; ?>"/><br/>
        <strong>Client ID: </strong> <input type="text" name="clientID" value="<?php echo$row->clientID; ?>"/><br/>
        <strong>Data introducerii: </strong> <input type="text" name="dataintroducerii" value="<?php echo$row->dataintroducerii; ?>"/><br/>
        <strong>Stare comanda: </strong> <input type="text" name="stare_comanda" value="<?php echo$row->stare_comanda;  }}}?>"/><br/>
        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="Vizualizare_comenzi.php">Index</a>
    </div></form></body> </html>