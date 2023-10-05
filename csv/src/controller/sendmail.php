<?php
if (isset($_POST['email']) && isset($_POST['fileFiltred'])) {
    $to = $_POST['email'];
    $subject = "Ton fichier CSV filtré";
    $message = "Voici ton fichier CSV filtré.";
    $headers = "From: no-reply@example.com\r\n";

    $file_path = realpath(__DIR__ . '/../../public/upload/' . $_POST['fileFiltred']);
    if ($file_path !== FALSE && is_readable($file_path)) {
        $file_name = basename($file_path);

        $boundary = md5("random");
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";

        $body = "--$boundary\r\n";
        $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $body .= chunk_split(base64_encode($message));

        $body .= "--$boundary\r\n";
        $body .= "Content-Type: application/octet-stream; name=" . $file_name . "\r\n";
        $body .= "Content-Disposition: attachment; filename=" . $file_name . "\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n";
        $body .= "X-Attachment-Id: " . rand(1000, 99999) . "\r\n\r\n";
        $body .= chunk_split(base64_encode(file_get_contents($file_path))); // Lecture du fichier à partir du chemin

        if (mail($to, $subject, $body, $headers)) {
            echo $twig->render('home.html.twig', ['successmail' => "Email envoyé avec succès."]);
        } else {
            echo $twig->render('home.html.twig', ['erreur' => "Échec de l'envoi de l'email."]);
        }
    }
}