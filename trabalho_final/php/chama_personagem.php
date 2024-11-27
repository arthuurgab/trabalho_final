<?php
    require 'banco.php';

    $input = json_decode(file_get_contents('php://input'), true);
    $nameInput = $input['name'];
    $homeworldInput = $input['homeworld'];

    $apiUrl = "https://swapi.dev/api/people/?search=" . urlencode($nameInput);

    $response = file_get_contents($apiUrl);

    if ($response === FALSE) {
        die("Erro ao acessar a API.");
    }

    $data = json_decode($response, true);

    if (isset($data['results']) && count($data['results']) > 0) {
        $characters = $data['results'];

        foreach ($characters as $character) {
            $name = $character['name'];
            $height = $character['height'];
            $gender = $character['gender'];
            $homeworld = $character['homeworld']; 

            if ($homeworld === $homeworldInput) {
                $sql = "INSERT INTO personagem (name, gender, height, homeworld) 
                        VALUES (:name, :gender, :height, :homeworld)";
                
                $stmt = $con->prepare($sql);
                $stmt->execute([
                    ':name' => $name,
                    ':gender' => $gender,
                    ':height' => $height,
                    ':homeworld' => $homeworld
                ]);

                echo "Personagem inserido: $name<br>";
            } else {
                echo "Homeworld não corresponde ao filtro para o personagem: $name<br>";
            }
        }
    }
?>