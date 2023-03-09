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
// verificam daca numele... nu sunt goale
        if ($nume == '' || $pret == ''|| $imagine==''|| $categorie==''|| $descriere==''||$desc_completa==''||
            $stare == '' || $oferta == ''|| $noutati==''|| $cod==''|| $metal==''||$piatra=='')
        { // daca sunt goale afisam mesaj de eroare
            echo "<div> ERROR: Completati campurile obligatorii!</div>";
        }
        else
        { // daca nu sunt erori se face update nume...
            if ($stmt = $mysqli->prepare("UPDATE produse SET nume=?,pret=?,imagine=?,categorie=?,descriere=?, 
                                    desc_completa=?,stare=?,oferta=?,noutati=?,cod=?, metal=?,piatra=? WHERE produsid='".$id."'"))
            {
                $stmt->bind_param("sisssssiisss", $nume, $pret,$imagine,$categorie,$descriere,$desc_completa,$stare,
                    $oferta,$noutati,$cod,$metal,$piatra);
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
            if ($result = $mysqli->query("SELECT * FROM produse where produsid='".$_GET['id']."'"))
            {
            if ($result->num_rows > 0)
            { $row = $result->fetch_object();?>
        </p>
        <strong>Nume: </strong> <input type="text" name="nume" value="<?php echo$row->nume; ?>"/><br/>
        <strong>Pret: </strong> <input type="text" name="pret" value="<?php echo$row->pret; ?>"/><br/>
        <strong>Imagine: </strong> <input type="text" name="imagine" value="<?php echo$row->imagine; ?>"/><br/>
        <strong>Categorie: </strong> <input type="text" name="categorie" value="<?php echo$row->categorie; ?>"/><br/>
        <strong>Descriere: </strong> <input type="text" name="descriere" value="<?php echo$row->descriere; ?>"/><br/>
        <strong>Descriere completa: </strong> <input type="text" name="desc_completa" value="<?php echo $row->desc_completa;?>"/><br/>
        <strong>Stare: </strong> <input type="text" name="stare" value="<?php echo$row->stare; ?>"/><br/>
        <strong>Oferta: </strong> <input type="text" name="oferta" value="<?php echo$row->oferta; ?>"/><br/>
        <strong>Noutati: </strong> <input type="text" name="noutati" value="<?php echo$row->noutati; ?>"/><br/>
        <strong>Cod: </strong> <input type="text" name="cod" value="<?php echo$row->cod; ?>"/><br/>
        <strong>Metal: </strong> <input type="text" name="metal" value="<?php echo$row->metal; ?>"/><br/>
        <strong>Piatra: </strong> <input type="text" name="piatra" value="<?php echo$row->piatra;  }}}?>"/><br/>
        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="Vizualizare.php">Index</a>
    </div></form></body> </html>