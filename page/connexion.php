<?php include '../includes/header.php' ?>
<main>
    <?php if (isset($_SESSION['email'])): ?>
        <p><?= "Bienvenue " . $_SESSION['firstname']; ?></p>
        <ul>
            <li><a href="../page/wishlist.php">Ma WishList</a></li>
            <li>Mes commandes</li>
            <li>Mes informations</li>
        </ul>
        <a href="../includes/logout.php">Se déconnecter</a>
    <?php else: ?>
        <div>
            <h2>connexion</h2>
            <form action="../includes/login.php">
                <input type="email" name="" id="" placeholder="Email">
                <input type="password" name="" id="" placeholder="Mot de passe">
                <button type="submit">connexion</button>
            </form>
            <a href="../includes/register.php">Créer un compte</a>
        </div>
    <?php endif; ?>
</main>
<?php include '../includes/footer.php' ?>