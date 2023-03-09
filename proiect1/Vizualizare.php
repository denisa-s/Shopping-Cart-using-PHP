<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Vizualizare Inregistrari</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1>Inregistrarile din tabela produse</h1>
<div><a href="Inserare.php">Adaugarea unei noi inregistrari</a></div>
<div><a href="Vizualizare_clienti.php">Vizualizare clienti</a></div>
<div><a href="Vizualizare_comenzi.php">Vizualizare comenzi</a></div>
<div><a href="logout_admin.php">Log out</a></div>
<?php
// connectare bazadedate
include("Conectare.php");
// se preiau inregistrarile din baza de date
if ($result = $mysqli->query("SELECT * FROM produse ORDER BY produsid "))
{ // Afisare inregistrari pe ecran
    if ($result->num_rows > 0)
    {
// afisarea inregistrarilor intr-o table
        echo "<table border='1' cellpadding='10'>";
// antetul tabelului
        echo "<tr><th>Produs ID</th>
                <th>Nume</th>
                <th>Pret</th>
                <th>Imagine</th>
                <th>Categorie</th>
                <th>Descriere</th>
                <th>Descriere completa</th>
                <th>Stare</th>
                <th>Oferta</th>
                <th>Noutati</th>
                <th>Cod</th>
                <th>Metal</th>
                <th>Piatra</th>
                <th></th><th></th></tr>";
        while ($row = $result->fetch_object())
        {
// definirea unei linii pt fiecare inregistrare
            echo "<tr>";
            echo "<td>" . $row->produsid . "</td>";
            echo "<td>" . $row->nume . "</td>";
            echo "<td>" . $row->pret . "</td>";
            echo "<td><a src='product-images'>" . $row->imagine . "</a></td>";
            echo "<td>" . $row->categorie . "</td>";
            echo "<td>" . $row->descriere . "</td>";
            echo "<td>" . $row->desc_completa . "</td>";
            echo "<td>" . $row->stare . "</td>";
            echo "<td>" . $row->oferta . "</td>";
            echo "<td>" . $row->noutati . "</td>";
            echo "<td>" . $row->cod . "</td>";
            echo "<td>" . $row->metal . "</td>";
            echo "<td>" . $row->piatra . "</td>";
            echo "<td><a href='Modificare.php?id=" . $row->produsid . "'>Modificare</a></td>";
            echo "<td><a href='Stergere.php?id=" .$row->produsid . "'>Stergere</a></td>";
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