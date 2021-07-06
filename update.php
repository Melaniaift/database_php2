<?php
require_once 'connection.php';
$sql1="DROP trigger IF EXISTS MysqlTrigger1";
$sql2="CREATE TRIGGER MysqlTrigger1 BEFORE UPDATE ON flori FOR EACH ROW
    BEGIN
    SET NEW.nume=UPPER(NEW.nume);
    END;";
$stmt1=$con->prepare($sql1);
$stmt2=$con->prepare($sql2);
$stmt1->execute();
$stmt2->execute();

$nume='trandafiri1';
$culoare='rosii1';
$marime='mari';
$pret='10';
$sql="CALL updateFlori('{$nume}', '{$culoare}', '{$marime}', '{$pret}')";
$q=$con->query($sql);
if($q)
    echo "Data was successfully updated!";
?>
<a href="index.php">Index</a>