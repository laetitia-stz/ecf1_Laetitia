<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/ecf1/models/Connection.php";

class Utilisateur extends Connection
{
    private $id_utilisateur;
    private $email;
    private $password;
    private $lastname;
    private $firstname;

    public function getId_Utilisateur()
    {
        return $this->id_utilisateur;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function getLastname()
    {
        return $this->lastname;
    }
    public function getFirstname()
    {
        return $this->firstname;
    }


    public function setId_Utilisateur($id_utilisateur)
    {
        return $this->id_utilisateur = $id_utilisateur;
    }
    public function setEmail($email)
    {
        return $this->email = $email;
    }
    public function setPassword($password)
    {
        return $this->password = $password;
    }

    public function setLastname($lastname)
    {
        return $this->lastname = $lastname;
    }

    public function setFirstname($firstname)
    {
        return $this->firstname = $firstname;
    }


    public function create($donnees)
    {
        $db = Connection::getConnect();
        if (isset($donnees['password'])) {
        
        }
        $champs = "";
        $valeurs = "";
        foreach ($donnees as $indice => $valeur) {
            $champs .= ($champs ? "," : "") . $indice;
            $valeurs .= ($valeurs ? "," : "") . "'$valeur'";
        }

        $sql = $db->prepare("INSERT INTO utilisateur ($champs)  VALUES ($valeurs)");
        if ($sql->execute()) {
            header('Location:' . $_SERVER['PHP_SELF']);
        }
    }

    public function read()
    {
        $db = Connection::getConnect();
        $sql = "SELECT * FROM utilisateur";
        $result = $db->query($sql);

        return $result->fetchAll();
    }

    public function login($email, $password)
    {
            $utilisateur = new Utilisateur();
            $infoUser = $utilisateur->read();

            foreach ($infoUser as $value) {
               
                if ($password == $value['password']) {
           
                $_SESSION['utilisateur'] = $value;
 
                header("Location: /ecf1/views/catalogue.php");
                exit();

                } 
            
        }
    }
}

