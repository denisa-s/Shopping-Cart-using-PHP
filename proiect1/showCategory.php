<?php
$k=$_POST['id'];
$k=trim($k); //pt nu avea blank spaces
$con = mysqli_connect("localhost","root","","proiect");
$sql="SELECT * FROM produse where categorie='{$k}'";
$res=mysqli_query($con,$sql);
while($rows=mysqli_fetch_array($res)){?>
<tr>
    <td><?php echo $rows['produsid']; ?></td>
    <td><?php echo $rows['nume']; ?></td>
    <td><?php echo $rows['pret']; ?></td>
    <td><?php echo $rows['descriere']; ?></td>
    <td><?php echo $rows['stare']; ?></td>
</tr>
<?php
}
?>