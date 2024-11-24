<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200..1000&family=Tenor+Sans&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <title>Jewelry PHP</title>
</head>

<body>
    <?php include './includes/header.php'; ?>
    <main>
        <div class="products">
            <?php
            // Connexion à la base de donnée 
            $con = mysqli_connect("db", "root", "example", "elise_product");

            if (!$con) {
                echo '<div>Pas de connexion à la base de données</div>';
            } else {
                // Récupération des données de la bases de données
                $req1 = mysqli_query($con, "SELECT * FROM jewelry");

                // Si aucune ligne n'a été retournée par la requête SQL.
                if (mysqli_num_rows($req1) == 0) {
                    echo '<div>Aucun produits trouvés ...</div>';
                } else {
                    while ($row = mysqli_fetch_assoc($req1)) {
                        echo '<li class="jewelry-product">
                    <div class="img-list-jewelry">
                        <a href="/page/detail.php?' . $row['id'] . '">
                            <img src="' . $row['image'] . '" alt="' . $row['name'] . '" />
                        </a>
                    </div>
                    <div class="detail-list-jewelry">
                        <p class="name-list-jewelry">' . $row['name'] . '</p>
                        <p class="price-list-jewelry"> ' . $row['price'] . ' €</p>
                    </div>
                  </li>';
                    }
                }
            }
            ?>
        </div>
    </main>
    <?php include './includes/footer.php' ?>
</body>

</html>

<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        list-style: none;
        font-family: 'Tenor Sans', verdana;
    }

    body {
        width: 100%;
    }

    main {
        display: flex;
        justify-content: center;
    }

    .products {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 20px;
        width: 90%;
        margin: 20px 0;
    }

    .name-list-jewelry {
        text-transform: uppercase;
    }

    .price-list-jewelry {
        font-family: 'Nunito Sans', verdana;
    }

    .img-list-jewelry {
        width: 400px;
        height: 400px;
        margin-bottom: 10px;
        transition: 0.3s ease-in-out;
    }

    .img-list-jewelry img {
        width: 100%;
        height: 100%;
    }

    .img-list-jewelry:hover {
        transform: scale(1.05);
        cursor: pointer;
    }
</style>