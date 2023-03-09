<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Vizualizare Inregistrari</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1>Inregistrarile din tabela comenzi</h1>
<div><a href="Inserare_comenzi.php">Adaugarea unei noi inregistrari</a></div>
<div><a href="Vizualizare_clienti.php">Vizualizare clienti</a></div>
<div><a href="Vizualizare.php">Vizualizare clienti</a></div>
<div><a href="logout_admin.php">Log out</a></div>
<?php
// connectare bazadedate
include("Conectare.php");
// se preiau inregistrarile din baza de date
if ($result = $mysqli->query("SELECT * FROM comanda ORDER BY id "))
{ // Afisare inregistrari pe ecran
    if ($result->num_rows > 0)
    {
// afisarea inregistrarilor intr-o table
        echo "<table border='1' cellpadding='10'>";
// antetul tabelului
        echo "<tr><th>ID</th>
                <th>Total</th>
                <th>Client ID</th>
                <th>Data introducerii</th>
                <th>Stare comanda</th>
                <th></th><th></th></tr>";
        while ($row = $result->fetch_object())
        {
// definirea unei linii pt fiecare inregistrare
            echo "<tr>";
            echo "<td>" . $row->id . "</td>";
            echo "<td>" . $row->total . "</td>";
            echo "<td>" . $row->clientID . "</td>";
            echo "<td>" . $row->dataintroducerii . "</td>";
            echo "<td>" . $row->stare_comanda . "</td>";
            echo "<td><a href='Modificare_comenzi.php?id=" . $row->id . "'>Modificare</a></td>";
            echo "<td><a href='Stergere_comenzi.php?id=" .$row->id . "'>Stergere</a></td>";
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