<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'] . "/ecf1/views/header.html";
require_once $_SERVER['DOCUMENT_ROOT'] . "/ecf1/models/Produit.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/ecf1/models/Utilisateur.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ecf1/models/Commande.php";

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

if (isset($_POST['btLogout'])) {
    unset($_SESSION['utilisateur']);
    unset($_SESSION['panier']);

    header("Location: /ecf1/index.php");
} else {
}
?>

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

    <div class='panier'>
        <h1>Mon Panier</h1>

        <?php 
        if (!empty($_SESSION['panier'])) {

            echo "<table>  
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Total</th>
            </tr>";

            $produitModel = new Produit();

            $totalFacture = 0;
            $nbLigne = 0;
 
            foreach ($_SESSION['panier'] as $id_produit => $quantite) {
                $detail = $produitModel->readID($id_produit);
                $totalLigne = $quantite * $detail['price'];
                $totalFacture += $totalLigne;
                $nbLigne++;
            
                echo "  <tr>
                  <td>" . $detail['name'] . "</td>
                  <td>" . number_format($detail['price'], 2, ',', '') . " €</td>
                  <td>" . $quantite . "</td>
                  <td>" . number_format($totalLigne, 2, ',', '')  . " €</td>
                  </tr>";
            }
             
           
            echo "<tr>
                    <th>Total de ligne : " . $nbLigne . "</td>
                    <th colspan='3'>Total facture : " . number_format($totalFacture, 2, ',', '')  . " €</td>
                    </tr>  ";

            echo " </table>";
           ?>
  </div>

    <div id='btCommander'>
        <form method='POST' action='/ecf1/views/commande.php'>
            <input type='submit' name='btCommander' value='Commander' class='bt'>
        </form>
    </div>

<?php

        } else {
            echo "
        <div class='PanierVide'>
        <div id='msgPanierVide'>Aucun article dans votre panier</div>
        <a href='catalogue.php'>Retour au catalogue</a>
        </div>";
        }
?>
</body>

</html>