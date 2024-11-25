<?php
if (!empty($_POST)) {
    $errors = [];
    if (empty($_POST['firstname-register']) || !preg_match("/^[a-zA-ZÀ-ÿ\- ]+$/", $_POST['firstname-register'])) {
        $errors['firstname-register'] = "Le prénom doit contenir que des lettres";
    }

    if (empty($_POST['lastname-register']) || !preg_match("/^[a-zA-ZÀ-ÿ\- ]+$/", $_POST['lastname-register'])) {
        $errors['lastname-register'] = "Le nom doit seulement contenir des lettres";
    }

    if (empty($_POST['email-register']) || !filter_var($_POST['email-register'], FILTER_VALIDATE_EMAIL)) {
        $errors['email-register'] = "Votre email n'est pas valide";
    }

    if (empty($_POST['password-register'])) {
        $errors['password-register'] = "Le mot de passe est obligatoire.";
    } else if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/", $_POST['password-register'])) {
        $errors['password-register'] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre.";
    }

    var_dump($errors);
}
?>

<div class="form-container">
    <h2>Créer un compte</h2>
    <form action="" method="POST">
        <input type="text" name="firstname-register" placeholder="Prénom">
        <input type="text" name="lastname-register" placeholder="Nom de famille">
        <input type="email" name="email-register" id="" placeholder="Email">
        <input type="password" name="password-register" id="" placeholder="Mot de passe">
        <button type="submit">Créer</button>
    </form>
</div>