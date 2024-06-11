<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/ecf1/models/Connection.php";

class Produit extends Connection
{
    private $id_produit;
    private $name;
    private $price;

    public function getId_Produit()
    {
        return $this->id_produit;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPrice()
    {
        return $this->price;
    }


    public function setId_Produit($id_produit)
    {
        return $this->id_produit = $id_produit;
    }
    public function setName($name)
    {
        return $this->name = $name;
    }
    public function setPrice($price)
    {
        return $this->price = $price;
    }


    public function create($donnees)
    {
        $db = Connection::getConnect();

        $champs = "";
        $valeurs = "";

        foreach ($donnees as $indice => $valeur) {
            $champs .= ($champs ? "," : "") . $indice;
            $valeurs .= ($valeurs ? "," : "") . "'$valeur'";
        }

        $sql = $db->prepare("INSERT INTO produit ($champs)  VALUES ($valeurs)");
        if ($sql->execute()) {
            header('Location:' . $_SERVER['PHP_SELF']);
        }
    }

    public function read()
    {
        $db = Connection::getConnect();
        $sql = $db->prepare("SELECT * FROM produit");
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readID()
    {
        $db = Connection::getConnect();
        $sql = $db->prepare("SELECT * FROM produit WHERE id_produit= :id_produit");
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

}
