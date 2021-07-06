<?php
require_once 'connection.php';
$sql1="DROP PROCEDURE IF EXISTS procedura3";
$sql2="CREATE PROCEDURE procedura3( 
 IN strNume varchar(30)
) 
BEGIN 
      DELETE FROM flori WHERE nume=strNume;
END;";
$stmt1=$con->prepare($sql1);
$stmt2=$con->prepare($sql2);
$stmt1->execute();
$stmt2->execute();

$sql3="DROP trigger IF EXISTS after_delete";
$sql4="CREATE TRIGGER after_delete AFTER DELETE ON flori FOR EACH ROW
    BEGIN
    INSERT INTO flori_updated(nume,status,edtime)VALUES(OLD.nume,'DELETED',NOW());
    END;";
$stmt3=$con->prepare($sql3);
$stmt4=$con->prepare($sql4);
$stmt3->execute();
$stmt4->execute();

$nume='trandafiri';
$sql="CALL procedura3('{$nume}')";
$q=$con->query($sql);
if($q)
    echo "Data was successfully deleted!";
?>
<a href="index.php">Index</a>