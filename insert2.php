<?php
require_once 'connection.php';
echo "<table border='1'>
    <tr>
    <th>Nume</th>
    <th>Culoare</th>
    <th>Marime</th>
    <th>Pret</th>
    </tr>";
$sql="SELECT * FROM flori";
foreach ($con->query($sql) as $row)
        {
    echo "<tr>";
    echo "<td>".$row['nume']."</td>";
    echo "<td>".$row['culoare']."</td>";
    echo "<td>".$row['marime']."</td>";
    echo "<td>".$row['pret']."</td>";
        }
        $sql1="DROP PROCEDURE IF EXISTS procedura2";
$sql2="CREATE PROCEDURE procedura2( 
 IN strNume varchar(30), 
 IN strCuloare varchar(30),
 IN strMarime varchar(30),
 IN intPret int
)
BEGIN
SET @nume=strNume;
SET @culoare=strCuloare;
SET @marime=strMarime;
SET @pret=intPret;

PREPARE STMT FROM
'INSERT INTO flori(nume,culoare,marime,pret) VALUES (?,?,?,?)';
EXECUTE STMT USING @nume,@culoare,@marime,@pret;
END;";
$stmt1=$con->prepare($sql1);
$stmt2=$con->prepare($sql2);
$stmt1->execute();
$stmt2->execute();
$nume="trandafiri";
$culoare="rosii";
$marime="mari";
$pret="443";
$sql3="CALL procedura2('{$nume}','{$culoare}','{$marime}','{$pret}')";
//$sql2="CALL insertFlower('11111','2222','33333','121212')";
$q=$con->query($sql3);
if($q){
    echo "Data was successfully inserted";
}  else {
echo "Vai vai vai!!!";    
}
echo "<br><br>";
echo "<a href='index.php'>Index</a>";
echo "<br><br>";
echo "<table border='1'>
    <tr>
    <th>Nume</th>
    <th>Culoare</th>
    <th>Marime</th>
    <th>Pret</th>
    </tr>";
$sql4="SELECT * FROM flori";
foreach ($con->query($sql4) as $row)
        {
    echo "<tr>";
    echo "<td>".$row['nume']."</td>";
    echo "<td>".$row['culoare']."</td>";
    echo "<td>".$row['marime']."</td>";
    echo "<td>".$row['pret']."</td>";
        }
?>