<?php
require 'banco.php';

$input = json_decode(file_get_contents('php://input'), true);

$id = $input['id'];
$name = $input['name'];
$gender = $input['gender'];
$height = $input['height'];
$homeworld = $input['homeworld'];

try {
    // Atualizar o personagem no banco de dados
    $sql = "UPDATE personagem SET name = :name, gender = :gender, height = :height, homeworld = :homeworld WHERE id = :id";
    $stmt = $con->prepare($sql);
    $stmt->execute([
        ':id' => $id,
        ':name' => $name,
        ':gender' => $gender,
        ':height' => $height,
        ':homeworld' => $homeworld
    ]);

    echo "Personagem atualizado com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao atualizar personagem: " . $e->getMessage();
}
?>