<?php
session_start();

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

include $_SERVER['DOCUMENT_ROOT'] . "/ecf1/views/header.html";
require_once $_SERVER['DOCUMENT_ROOT'] . "/ecf1/controllers/ProduitCTRL.php";

$produit = new ProduitController();

//************ Ajout produits au panier ***********//

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btAjoutPanier'])) {
    $id_produit = $_POST['id_produit'];
    $quantite = $_POST['quantite'];

    if (isset($_SESSION['panier'][$id_produit])) {
        $_SESSION['panier'][$id_produit] += $quantite;
    } else {
        $_SESSION['panier'][$id_produit] = $quantite;
    }
}
?>


<!-- ************ NAV *********** -->

<body>
    <nav>
        <div class="accueil">
            <a href="../index.php">Accueil</a>
        </div>

        <div class="form">
            <form method="POST" action="">
                <input type="submit" id="btLogout" name='btLogout' value="Se déconnecter">
            </form>
        </div>
    </nav>


    <!-- ************ Liste produits *********** -->
    <main>
        <div class="titreProduits">
            <h1>Nos produits</h1>
        </div>

        <div class="voir">
            <form method="POST" action="panier.php">
                <button type="submit" id="submitPanier" name="submitPanier">Voir mon panier</button>
            </form>
        </div>
       
        <div class='tabProduits'>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Mettre au panier</th>
                </tr>

                <?php
                foreach ($produit->afficher() as $value) {
                    echo "
                    <tr>
                    <form method='POST' action='catalogue.php'>
                        <td>" . $value['name'] . "</td>
                        <td>" . number_format($value['price'], 2, ',', '') . " €</td>
                        <td> 
                        <select name='quantite'>";
                    for ($i = 1; $i <= 10; $i++) {
                        echo "<option id='quantite' value='$i'>$i</option>";
                    }
                    echo "</select>
                        </td>
                        <td>
                            <input type='hidden' name='id_produit' value='" . $value['id_produit'] . "'>
                            <input type='submit' class='btAjoutPanier' name='btAjoutPanier' value='Ajouter'>
                        </td>
                        </form>
                    </tr>";
                     } 
                ?>
            </table>
        </div>
    </main>

</body>";