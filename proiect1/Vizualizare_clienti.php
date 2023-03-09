<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Vizualizare Inregistrari Clienti</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1>Inregistrarile din tabela clienti</h1>
<div><a href="Inserare_clienti.php">Adaugarea unei noi inregistrari</a></div>
<div><a href="Vizualizare.php">Vizualizare produse</a></div>
<div><a href="Vizualizare_comenzi.php">Vizualizare comenzi</a></div>
<div><a href="logout_admin.php">Log out</a></div>
<?php
// connectare bazadedate
include("Conectare.php");
// se preiau inregistrarile din baza de date
if ($result = $mysqli->query("SELECT * FROM `clienti` ORDER BY id "))
{ // Afisare inregistrari pe ecran
    if ($result->num_rows > 0)
    {
// afisarea inregistrarilor intr-o table
        echo "<table border='1' cellpadding='10'>";
        // antetul tabelului
        echo "<tr><th>ID Client</th><th>Username</th><th>Parola</th><th>Email</th>
                <th>Strada</th><th>Oras</th><th>Tara</th><th>Cod Postal</th><th>Numar card</th>
                <th>Tip card</th> <th>Data expirare card</th><th>Acceptare email</th><th>Nr inreg RC</th>
                <th>Nume client</th><th>Cod fiscal</th><th></th><th></th></tr>";
        while ($row = $result->fetch_object())
        {
// definirea unei linii pt fiecare inregistrare
            echo "<tr>";
            echo "<td>" . $row->id . "</td>";
            echo "<td>" . $row->username . "</td>";
            echo "<td>" . $row->password . "</td>";
            echo "<td>" . $row->email . "</td>";
            echo "<td>" . $row->strada . "</td>";
            echo "<td>" . $row->oras . "</td>";
            echo "<td>" . $row->tara . "</td>";
            echo "<td>" . $row->codpostal . "</td>";
            echo "<td>" . $row->nrcard . "</td>";
            echo "<td>" . $row->tipcard . "</td>";
            echo "<td>" . $row->dataexpcard . "</td>";
            echo "<td>" . $row->acceptareemail . "</td>";
            echo "<td>" . $row->nrinregRC . "</td>";
            echo "<td>" . $row->nume . "</td>";
            echo "<td>" . $row->codfiscal . "</td>";
            echo "<td><a href='Modificare_clienti.php?id=" . $row->id . "'>Modificare</a></td>";
            echo "<td><a href='Stergere_clienti.php?id=" .$row->id . "'>Stergere</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
// daca nu sunt inregistrari se afiseaza un rezultat de eroare
    else
    {
        echo "Nu sunt inregistrari in tabela!";
    }
}
// eroare in caz de insucces in interogare
else
{ echo "Error: " . $mysqli->error(); }
// se inchide
$mysqli->close();
?>

</body>
</html>
<?php
