<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'] . "/ecf1/views/header.html";
require_once $_SERVER['DOCUMENT_ROOT'] . "/ecf1/controllers/ProduitCTRL.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/ecf1/models/Utilisateur.php";


$produit = new ProduitController();


/********** AUTHENTIFICATION **********/
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $utilisateur = new Utilisateur();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $utilisateur->login($email, $password);
}

?>


<body>
    <!-- ************ NAV *********** -->
    <nav>
        <div class="accueil">
            <a href="index.php">Accueil</a>
        </div>
        <div class="form">
            <form action="" method="POST">
                <input type="email" id="email" name="email" placeholder="email" required>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                <button type="submit">Se connecter</button>
            </form>
        </div>
    </nav>



    <!-- ************ Liste produits *********** -->
    <main>
        <div class="titreProduits">
            <h1>Nos produits</h1>
            <p>Veuillez vous identifier pour pouvoir commander.</p>
        </div>

        <div class='tabProduits'>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                </tr>

                <?php
                foreach ($produit->afficher() as $value) {
                    echo "
                    <tr>
                        <td>" . $value['name'] . "</td>
                        <td>" . number_format($value['price'], 2, ',', '') . "</td>
                    </tr>";
                }

                echo "</table>
        </div>
    </main>

</body>";
