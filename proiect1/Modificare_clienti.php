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
        $acceptareemail = htmlentities($_POST['acceptareemail'], ENT_QUOTES);
        $nrinregRC = htmlentities($_POST['nrinregRC'], ENT_QUOTES);
        $nume = htmlentities($_POST['nume'], ENT_QUOTES);
        $codfiscal = htmlentities($_POST['codfiscal'], ENT_QUOTES);
// verificam daca nu sunt goale
        if ($username == '' || $password == ''|| $email==''|| $strada==''|| $oras==''||$tara==''||
            $codpostal == '' || $nrcard == ''|| $tipcard==''|| $dataexpcard==''|| $acceptareemail==''||$nrinregRC==''||$nume==''||$codfiscal=='')
        { // daca sunt goale afisam mesaj de eroare
            echo "<div> ERROR: Completati campurile obligatorii!</div>";
        }
        else
        { // daca nu sunt erori se face update
            if ($stmt = $mysqli->prepare("UPDATE clienti SET username=?,password=?,email=?,strada=?,oras=?, 
                          tara=?,codpostal=?,nrcard=?,tipcard=?,dataexpcard=?,acceptareemail=?, 
                          nrinregRC=?, nume=?, codfiscal=? WHERE id='".$id."'"))
            {
                $stmt->bind_param("ssssssiissiisi", $username,
                    $password,$email,$strada,$oras,$tara,$codpostal,$nrcard,$tipcard,
                    $dataexpcard,$acceptareemail,$nrinregRC,$nume,$codfiscal);
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
            if ($result = $mysqli->query("SELECT * FROM clienti where id='".$_GET['id']."'"))
            {
            if ($result->num_rows > 0)
            { $row = $result->fetch_object();?></p>
        <strong>Username: </strong> <input type="text" name="username" value="<?php echo$row->username;
        ?>"/><br/>
        <strong>Parola: </strong> <input type="text" name="password" value="<?php echo$row->password;
        ?>"/><br/>
        <strong>Email: </strong> <input type="text" name="email" value="<?php echo$row->email;
        ?>"/><br/>
        <strong>Strada: </strong> <input type="text" name="strada" value="<?php echo$row->strada; ?>"/><br/>
        <strong>Oras: </strong> <input type="text" name="oras" value="<?php echo$row->oras; ?>"/><br/>
        <strong>Tara: </strong> <input type="text" name="tara" value="<?php echo $row->tara; ?>"/><br/>
        <strong>Cod_Postal: </strong> <input type="text" name="codpostal" value="<?php echo $row->codpostal; ?>"/><br/>
        <strong>Numar_card: </strong> <input type="text" name="nrcard" value="<?php echo $row->nrcard; ?>"/><br/>
        <strong>Tip_card: </strong> <input type="text" name="tipcard" value="<?php echo $row->tipcard; ?>"/><br/>
        <strong>Data_expirare_card: </strong> <input type="text" name="dataexpcard" value="<?php echo $row->dataexpcard; ?>"/><br/>
        <strong>Acceptare_email: </strong> <input type="text" name="acceptareemail" value="<?php echo $row->acceptareemail; ?>"/><br/>
        <strong>Nr_inreg_RC: </strong> <input type="text" name="nrinregRC" value="<?php echo $row->nrinregRC; ?>"/><br/>
        <strong>Nume_client: </strong> <input type="text" name="nume" value="<?php echo $row->nume; ?>"/><br/>
        <strong>Cod_fiscal: </strong> <input type="text" name="codfiscal" value="<?php echo $row->codfiscal;}}}?>"/><br/>
        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="Vizualizare_clienti.php">Index</a>
    </div></form></body> </html>
