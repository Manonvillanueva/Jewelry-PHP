<?php
// Démarrer la session au tout début, avant tout contenu HTML
session_start();

// Vérifie si la session est déjà démarrée
if (isset($_SESSION['email'])) {
    // Détruire toutes les variables de session
    session_unset();

    // Détruire la session
    session_destroy();
}

// Rediriger ou afficher un message après la déconnexion
header("Location: ../page/connexion.php"); // Redirige vers la page de connexion
exit(); // Assure-toi d'appeler exit après la redirection
