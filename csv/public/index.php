<!DOCTYPE html>
<html>
<head>
    <title>Upload CSV et affichage des données</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<h1>Upload un fichier CSV</h1>

<form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">

    Sélectionne un fichier CSV :
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>

<button id="loadGraph">Charger le graphique</button>

<h2>Graphique</h2>
<canvas id="myChart"></canvas>

<script src="script.js"></script>

</body>
</html>
