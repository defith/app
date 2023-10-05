<?php
//////////////////////////////////////////////////////////////////////////
// CONSTRUCTION DES DONNEES FILTRE >> FILTERED_ROW
//////////////////////////////////////////////////////////////////////////
if (isset($_POST['csv_content'])) {
    $post_data = $_POST;
    $csvContent = json_decode($_POST['csv_content'], true);
    
    // Initialisation des tableaux pour les lignes et les en-têtes filtrés
    $filtered_rows = [];
    
    // Récupérer les en-têtes à partir des clés du premier élément de $csvContent
    $headers = array_keys($csvContent[0]);
    $filtered_headers = [];

    // Identifier les en-têtes à inclure dans le CSV de sortie
    foreach ($headers as $header) {
        if (isset($post_data['checkbox_' . $header])) {
            $filtered_headers[] = $header;
        }
    }

    // Enlever la première ligne (en-têtes) pour ne filtrer que les données
    array_shift($csvContent);

    // Filtrer les lignes
    foreach ($csvContent as $row) {
        $include_row = true;
        $filtered_row = [];

        foreach ($filtered_headers as $header) {
            $cell_value = $row[$header];  // Utilise $header comme clé
            $operator = $post_data['select_' . $header] ?? '';
            $filter_value = $post_data['input_' . $header] ?? '';

            // Si "Pas de filtre" est sélectionné, inclure la cellule et continuer
            if ($operator === '') {
                $filtered_row[$header] = $cell_value;  // Nouvelle modification
                continue;
            }

            // Appliquer les filtres selon l'opérateur
            switch ($operator) {
                case '=':
                    $include_row = ($cell_value == $filter_value);
                    break;
                case '>':
                    $include_row = ($cell_value > $filter_value);
                    break;
                case '<':
                    $include_row = ($cell_value < $filter_value);
                    break;
                case '>=':
                    $include_row = ($cell_value >= $filter_value);
                    break;
                case '<=':
                    $include_row = ($cell_value <= $filter_value);
                    break;
                case '<>':
                    $include_row = ($cell_value != $filter_value);
                    break;
                case 'commence_par':
                    $include_row = (strpos($cell_value, $filter_value) === 0);
                    break;
            }

            if ($include_row) {
                $filtered_row[$header] = $cell_value;
            } else {
                break;
            }
        }
        // Si la ligne doit être incluse, l'ajouter aux lignes filtrées
        if ($include_row && !empty($filtered_row)) {
            $filtered_rows[] = $filtered_row;
        }
    }

//////////////////////////////////////////////////////////////////////////
// GENERATION DU FICHIER CSV FILTRE
//////////////////////////////////////////////////////////////////////////
    // Générer le fichier CSV de sortie
    list($usec, $sec) = explode(" ", microtime());
    $output_filename = sprintf('filtered_%d%d.csv', $sec, $usec * 1e6);
    $path_to_upload_folder = 'upload/';
    $full_path = $path_to_upload_folder . $output_filename;
    $output_file = fopen($full_path, 'w');
    foreach ($filtered_rows as $filtered_row) {
        fputcsv($output_file, $filtered_row);
    }
    fclose($output_file);

    // Convertis le contenu CSV original et les données filtrées en JSON
    $filtered_rows_json = json_encode($filtered_rows);

    echo $twig->render('home.html.twig', [
        'csv_content' => $csvContent,
        'filtered_csv_content' => $filtered_rows,
        'output_filename' => $output_filename
    ]);
    // Appelle la fonction pour le dossier que tu souhaites nettoyer
    deleteOldFiles('/var/www/html/public/upload');

}
