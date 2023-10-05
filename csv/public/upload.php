<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $file = fopen($target_file, 'r');
        $headers = fgetcsv($file);

        $data = [];
        while (($line = fgetcsv($file)) !== FALSE) {
            $data[] = array_combine($headers, $line);
        }
        fclose($file);

        $totals = [];
        foreach ($data as $row) {
            $product = $row['Produit'];
            $quantity = $row['Quantite'];
            if (!isset($totals[$product])) {
                $totals[$product] = 0;
            }
            $totals[$product] += $quantity;
        }

        $_SESSION['totals'] = $totals;

        echo json_encode([
            'totals' => $totals,
        ]);
    } else {
        echo json_encode([
            'error' => 'Erreur lors de l\'upload du fichier.'
        ]);
    }
} else {
    if (isset($_SESSION['totals'])) {
        echo json_encode([
            'totals' => $_SESSION['totals'],
        ]);
    } else {
        echo json_encode([
            'error' => 'Aucune donnée disponible.'
        ]);
    }
}
?>
