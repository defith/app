<?php
//////////////////////////////////////////////////////////////////////////
// CONSTRUTION DES DONNEES D'ENTREE >> CSV_CONTENT
//////////////////////////////////////////////////////////////////////////
if (isset($_FILES['csvFile'])) {
    $fileName = $_FILES['csvFile']['name'];
    $fileTmpPath = $_FILES['csvFile']['tmp_name'];
    $fileType = $_FILES['csvFile']['type'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    if ($fileExtension === 'csv' && $fileType === 'text/csv') {
        echo $twig->render('home.html.twig', ['csv_content' => loadcsv($_FILES['csvFile'])]);
    } else {
        echo $twig->render('home.html.twig', ['erreur' => "Le fichier doit être un CSV."]);
    }
} else {
    echo $twig->render('home.html.twig');
}
?>