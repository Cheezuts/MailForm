<?php
require('vendor/setasign/fpdf/fpdf.php');

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$message = $_POST['message'];
$check1 = isset($_POST['check1']) ? 'Oui' : 'Non';

// Créer une nouvelle instance de PDF
$pdf = new FPDF();

// Ajouter une page
$pdf->AddPage();

// Définir la police à Arial, gras, taille 14
$pdf->SetFont('Arial', 'B', 14);

// Écrire les données du formulaire dans le PDF
$pdf->Cell(40, 10, 'Nom: ' . $nom);
$pdf->Ln(); // Nouvelle ligne
$pdf->Cell(60, 10, 'Prénom: ' . $prenom);
$pdf->Ln(); // Nouvelle ligne
$pdf->Cell(60, 10, 'Email: ' . $email);
$pdf->Ln(); // Nouvelle ligne
$pdf->Cell(60, 10, 'Message: ' . $message);
$pdf->Ln(); // Nouvelle ligne
$pdf->Cell(60, 10, "J'accepte les conditions générales : " . $check1);

// Enregistrer le PDF en tant que fichier
$pdf->Output('F', 'formulaire.pdf');

// Définir les paramètres de l'e-mail
$destinataire = 'votre-adresse-email@exemple.com';
$sujet = 'Nouveau message depuis le formulaire de contact';
$entete = 'From: ' . $nom . ' ' . $prenom . ' <' . $email . '>' . "\r\n" .
    'Reply-To: ' . $email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

// Attacher le PDF à l'e-mail
$attachment = chunk_split(base64_encode(file_get_contents('formulaire.pdf')));
$boundary = md5(date('r', time()));

$entete .= "\r\nMIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"_1_$boundary\"";

$message = "\r\n--_1_$boundary\r\n" .
    "Content-Type: multipart/alternative; boundary=\"_2_$boundary\"\r\n" .
    "\r\n--_2_$boundary\r\n" .
    "Content-Type: text/plain; charset=\"iso-8859-1\"\r\n" .
    "Content-Transfer-Encoding: 7bit\r\n" .
    "\r\n$message\r\n" .
    "\r\n--_2_$boundary--\r\n" .
    "\r\n--_1_$boundary\r\n" .
    "Content-Type: application/octet-stream; name=\"formulaire.pdf\"\r\n" .
    "Content-Transfer-Encoding: base64\r\n" .
    "Content-Disposition: attachment\r\n" .
    "\r\n$attachment\r\n" .
    "\r\n--_1_$boundary--";

// Envoyer l'e-mail
if (mail($destinataire, $sujet, $message, $entete)) {
    // L'e-mail a été envoyé avec succès
    echo 'Votre message a été envoyé avec succès.';
} else {
    // Il y a eu une erreur lors de l'envoi de l'e-mail
    echo 'Il y a eu une erreur lors de l\'envoi de votre message. Veuillez réessayer plus tard.';
}
