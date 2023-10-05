<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <div id="drop_zone" style="border: 2px dashed #bbb; padding: 20px; text-align: center;">
        Glisser et déposer votre fichier CSV ici
    </div>
    <form id="fileForm" action="loadcsv" method="POST" enctype="multipart/form-data">
        <input type="file" id="hiddenFileInput" name="csvFile" style="display: none;">
        <input type="submit" id="submitBtn" style="display: none;">
    </form>
    </div>

    <div id="drop_zone" class="dropzone"><br>
    </div>
    <script src="js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>