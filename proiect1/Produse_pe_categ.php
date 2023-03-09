<?php
$con = mysqli_connect("localhost","root","","proiect");
$sql="SELECT Distinct categorie FROM produse";
$res=mysqli_query($con,$sql); //stocare rezultat in variabila
?>
<!DOCTYPE html>
<html>
<head>
    <title>Produse pe categorii</title>
    <script type="text/javascript" src="categs.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
 Selectati categoria:
<select id="produs" onchange="selectCategory()"> //pt cand se alege un elem din lista
    <?php while ($rows=mysqli_fetch_array($res)){
        ?>
        <option value="<?php echo $rows['categorie']; ?> "> <?php echo $rows['categorie']; ?> </option>
    <?php
    }?>
</select>
<table>
    <thead>
    <th style="width: 10%">Produs ID</th>
    <th style="width: 10%">Nume</th>
    <th style="width: 10%">Pret</th>
    <th style="width: 10%">Descriere</th>
    <th style="width: 10%">Stare</th>
    </thead>
    <tbody id="ans">
    </tbody>
</table>
 <div align="left"><a href="magazin.php">Inapoi la magazin</a></div>
</body>
</html>












