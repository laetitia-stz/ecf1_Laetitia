<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ecf1/models/Produit.php";

class ProduitController
{

    public function afficher()
    {
        $produit = new Produit();

        return $produit->read();
    }

    
}
