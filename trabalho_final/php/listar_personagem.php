<?php
require 'banco.php';

$sql = "SELECT * FROM personagem";
$stmt = $con->prepare($sql);
$stmt->execute();

$characters = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($characters);
?>
