<?php
require_once 'connection.php';
$sql1="DROP PROCEDURE IF EXISTS procedura0";
$sql2="CREATE PROCEDURE procedura0() 
BEGIN 
      SELECT * FROM flori;
END;";
$stmt1=$con->prepare($sql1);
$stmt2=$con->prepare($sql2);
$stmt1->execute();
$stmt2->execute();
$sql='CALL procedura0()';
$q=$con->query($sql);
$q->setFetchMode(PDO::FETCH_ASSOC);
?>
<table>
    <tr>
        <th>Nume</th>
        <th>Culoare</th>
        <th>Marime</th>
        <th>Pret</th>
    </tr>
    <?php while ($res=$q->fetch()): ?>
    <tr>
        <td><?php echo $res['nume']; ?></td>
        <td><?php echo $res['culoare']; ?></td>
        <td><?php echo $res['marime']; ?></td>
        <td><?php echo $res['pret']; ?></td>
    </tr>
     <?php endwhile; ?>
</table>
<a href="insert.php">Insert</a>
<a href="insert2.php">Insert2</a>
<a href="update.php">Update</a>
<a href="delete.php">Delete</a>
<a href="getflower.php">GetFlower</a>