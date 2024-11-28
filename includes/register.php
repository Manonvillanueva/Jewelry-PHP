<?php
// Démarrer la session avant toute autre chose
session_start();

if (!empty($_POST)) {

    // Tentative (try) de connexion à la base de données avec PDO
    try {
        // On essaie de créer une connexion à la base de données
        // $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass)
        $pdo = new PDO('mysql:host=jewelry-php-db-1;port=3306;dbname=elise_product', 'root', 'example');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Gérer les erreurs via exceptions
        // Si quelque chose se passe mal dans le bloc try, catch va capter (attraper) l'erreur
    } catch (PDOException $e) {
        // Si la connexion échoue, on affiche l'erreur et on arrête le script (die)
        // Le message d'erreur exact sera récupéré avec $e->getMessage()
        die("Erreur de connexion : " . $e->getMessage());
    }

    $errors = [];

    // VALIDATION PRENOM 
    // Vérifie si le prénom est vide ou contient des caractères invalides
    if (empty($_POST['firstname-register']) || !preg_match("/^[a-zA-ZÀ-ÿ\- ]+$/", $_POST['firstname-register'])) {
        $errors['firstname-register'] = "Le prénom doit contenir que des lettres";
    }

    // VALIDATION NOM 
    // Vérifie si le nom est vide ou contient des caractères invalides
    if (empty($_POST['lastname-register']) || !preg_match("/^[a-zA-ZÀ-ÿ\- ]+$/", $_POST['lastname-register'])) {
        $errors['lastname-register'] = "Le nom doit seulement contenir des lettres";
    }

    // VALIDATION MAIL 
    // Vérifie si le mail est vide ou qu'il soit correct avec FILTER_VALIDATE_EMAIL
    if (empty($_POST['email-register']) || !filter_var($_POST['email-register'], FILTER_VALIDATE_EMAIL)) {
        $errors['email-register'] = "Votre email n'est pas valide";
    } else {
        // Si l'email est valide, on vérifie qu'il n'existe pas déjà dans la base de données
        $req = $pdo->prepare('SELECT * FROM users WHERE email = :email ');
        $req->execute([':email' => $_POST['email-register']]);
        if ($req->rowCount() > 0) {
            $errors['email-register'] = "Cet e-mail est déjà utilisé. Veuillez en choisir un autre.";
        }
    }

    // VALIDATION PASSWORD 
    // Vérifie si le mot de passe est vide ou s'il ne respecte pas le format requis
    if (empty($_POST['password-register'])) {
        $errors['password-register'] = "Le mot de passe est obligatoire.";
    } else if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/", $_POST['password-register'])) {
        $errors['password-register'] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre.";
    }

    // Si aucun problème n'a été trouvé (le tableau d'erreurs est vide)
    if (empty($errors)) {

        // On utilise la fonction `password_hash` pour transformer le mot de passe en un format sécurisé dans la BDD
        $hashedPassword = password_hash($_POST['password-register'], PASSWORD_DEFAULT);
        // Préparation de la requête SQL pour insérer les données dans la table 'users'
        $query = $pdo->prepare('INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)');
        // Insertion dans la base de donnée 
        $query->execute([
            ':firstname' => $_POST['firstname-register'],
            ':lastname' => $_POST['lastname-register'],
            ':email' => $_POST['email-register'],
            ':password' => $hashedPassword
        ]);

        $_SESSION['email'] = $_POST['email-register'];
        $_SESSION['firstname'] = $_POST['firstname-register'];
        $_SESSION['lastname'] = $_POST['lastname-register'];
        // Redirection après validation du formulaire 
        header("Location: ../page/connexion.php");
        exit();
    }
    var_dump($errors);
}
?>

<div class="form-container">
    <h2>Créer un compte</h2>
    <form action="" method="POST">
        <!-- FIRSTNAME FIELD  -->
        <input type="text" name="firstname-register" placeholder="Prénom">
        <!-- LASTNAME FIELD  -->
        <input type="text" name="lastname-register" placeholder="Nom de famille">
        <!-- MAIL FIELD  -->
        <input type="email" name="email-register" id="" placeholder="Email">
        <!-- PASSWORD FIELD  -->
        <input type="password" name="password-register" id="" placeholder="Mot de passe">
        <!-- VALID FORM  -->
        <button type="submit">Créer</button>
    </form>
</div>