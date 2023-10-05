<?php
function loadcsv($file)
{
        $fileTmpPath = $file['tmp_name'];
        $csvFile = fopen($fileTmpPath, 'r');
        $csvContent = [];

        // Lire la première ligne pour obtenir les en-têtes
        $headers = fgetcsv($csvFile);
        $headers = array_map('trim', $headers);
        // Lire les lignes suivantes et les convertir en tableaux associatifs
        $csvContent = [];
        while (($row = fgetcsv($csvFile)) !== false) {
                $row = array_map('trim', $row);
                $csvContent[] = array_combine($headers, $row);
        }
        fclose($csvFile);
        return $csvContent;
}

function deleteOldFiles($dirPath, $maxAgeInSeconds = 3600)
{
        if (!is_dir($dirPath)) {
                return;
        }

        $files = glob($dirPath . '/*');

        $currentTime = time();

        foreach ($files as $file) {
                if (is_file($file)) {
                        $fileTime = filemtime($file);
                        if ($currentTime - $fileTime >= $maxAgeInSeconds) {
                                unlink($file);
                        }
                }
        }
}