<?php
// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$message = $_POST['message'];

// Définir les paramètres de l'e-mail
$destinataire = 'votre-adresse-email@exemple.com';
$sujet = 'Nouveau message depuis le formulaire de contact';
$entete = 'From: ' . $nom . ' ' . $prenom . ' <' . $email . '>' . "\r\n" .
    'Reply-To: ' . $email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

// Envoyer l'e-mail
if (mail($destinataire, $sujet, $message, $entete)) {
    // L'e-mail a été envoyé avec succès
    echo 'Votre message a été envoyé avec succès.';
} else {
    // Il y a eu une erreur lors de l'envoi de l'e-mail
    echo 'Il y a eu une erreur lors de l\'envoi de votre message. Veuillez réessayer plus tard.';
}
