<?php
// Démarrer la session pour accéder aux données de session
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet"> <!-- Lien FontAwesome -->
    <title>ELISE TSIKIS</title>
</head>

<body>
    <header class="header-site">
        <a href="/index.php">
            <h1>ELISE TSIKIS</h1>
        </a>

        <div class="nav-header">
            <!-- LINK WISHLIST -->
            <a href="../page/wishlist.php">
                <i class="fa-regular fa-heart" style="color: #323334;"></i>
            </a>
            <!-- LINK CONNEXION -->
            <a href="../page/connexion.php">
                <i class="fa-regular fa-user" style="color: #323334;"></i>
            </a>
            <!-- LINK BASKET SHOP -->
            <a href="../page/panier.php">
                <i class="fa-solid fa-basket-shopping" style="color: #323334;"></i>
            </a>
        </div>
    </header>

    <style>
        .header-site {
            display: flex;
            background: #F5F3EE;
            padding: 10px;
        }

        .header-site a {
            text-decoration: none;
            color: inherit;
        }

        .nav-header {
            display: flex;
            gap: 20px;
        }

        .nav-header i {
            font-size: 24px;
        }
    </style>