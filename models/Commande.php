<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/ecf1/models/Connection.php";

class Commande extends Connection
{
    private $id_commande;
    private $numero_commande;

    public function __construct() {
        $this->numero_commande = (new DateTime())->format('YmdHis');
    }

    public function getId_Commande()
    {
        return $this->id_commande;
    }
    public function getNumero_Commande()
    {
        return $this->numero_commande;
    }


    public function setId_Commande($id_commande)
    {
        return $this->id_commande = $id_commande;
    }
    public function setNumero_Commande($numero_commande)
    {
        return $this->numero_commande = $numero_commande;
    }

    public function create()
    {
        $db = Connection::getConnect();
        $id_utilisateur = $_SESSION['utilisateur']['id_utilisateur'];
       
        $quantite = $_SESSION['panier']['quantite'];
        $id_produit = $_SESSION['panier']['id_produit'];

        $sql = $db->prepare("INSERT INTO commande (id_utilisateur, id_produit, quantite) VALUES (?, ?, ?)");
       
            if ( $sql->execute([$id_utilisateur, $id_produit, $quantite])) {

                header('Location /ecf1/views/commande.php');
           }
    }

    public function read()
    {
        $db = Connection::getConnect();
        $sql = "SELECT * FROM commande";
        $result = $db->query($sql);

        return $result->fetchAll();
    }

}
