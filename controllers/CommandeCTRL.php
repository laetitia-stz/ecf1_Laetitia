<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ecf1/models/Commande.php";


class CommandeController
{
    public function ajoutBD()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $commande  = new Commande();

            $commande->create($_POST);
        }

//require_once $_SERVER['DOCUMENT_ROOT'] . "/ecf1/views/panier.php";
    }
}