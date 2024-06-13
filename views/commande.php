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
    exit();
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

<?php   
if (isset($_POST['btCommander'])) {
        $_SESSION['utilisateur'];
        $_SESSION['panier'];

    $commande = new Commande;
    $commande->create();

 
    echo "
    <div class='CommandeValide'>
    <div id='msgCommandeValide'>Votre commande a bien été reçue</div>
    <a href='catalogue.php'>Retour au catalogue</a>
    </div>"; 
    
    exit();
}

?>

</body>

</html>