<?php
require 'banco.php';

$input = json_decode(file_get_contents('php://input'), true);

$id = $input['id'];

try {
    $sql = "DELETE FROM personagem WHERE id = :id";
    $stmt = $con->prepare($sql);
    $stmt->execute([':id' => $id]);

    echo "Personagem excluído com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao excluir personagem: " . $e->getMessage();
}
?>
