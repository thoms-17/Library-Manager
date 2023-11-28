<?php

namespace App\Models;

use App\Database;
use PDO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class User
{
    private $username;
    private $email;
    private $password;
    private $creation_date;
    private static $pdo;

    public function __construct()
    {
        // Vérifier si l'instance de la connexion n'a pas déjà été créée, sinon la créer
        if (!self::$pdo) {
            self::$pdo = Database::connect();
        }
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        // Hashage du mot de passe pour le sécuriser
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }

    public function save()
    {
        // Vérifier que l'utilisateur n'existe pas déjà dans la base de données
        if ($this->userExists($this->username, $this->email)) {
            throw new \Exception('L\'utilisateur existe déjà.');
        }

        // Préparation de la requête SQL avec des paramètres nommés
        $query = "INSERT INTO users (username, email, password, creation_date) VALUES (:username, :email, :password, :creation_date)";
        $statement = self::$pdo->prepare($query);

        // Liaison des valeurs avec les paramètres
        $statement->bindValue(':username', $this->username);
        $statement->bindValue(':email', $this->email);
        $statement->bindValue(':password', $this->password);
        $statement->bindValue(':creation_date', $this->creation_date);

        // Exécution de la requête préparée
        if (!$statement->execute()) {
            throw new \Exception('Erreur lors de l\'enregistrement de l\'utilisateur.');
        }
    }

    public function userExists($username, $email)
    {
        // Vérifier si l'utilisateur existe déjà dans la base de données
        $query = "SELECT COUNT(*) as count FROM users WHERE username = :username OR email = :email";
        $statement = self::$pdo->prepare($query);

        // Liaison des valeurs avec les paramètres
        $statement->bindValue(':username', $username);
        $statement->bindValue(':email', $email);

        // Exécution de la requête préparée
        $statement->execute();

        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        return $result['count'] > 0;
    }

    public function authenticate($username, $password)
    {
        // Requête pour récupérer les informations de l'utilisateur correspondant au nom d'utilisateur fourni.
        $query = "SELECT * FROM users WHERE username = :username";
        $statement = self::$pdo->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        // Vérifier si l'utilisateur existe et si le mot de passe est correct.
        if ($user && password_verify($password, $user['password'])) {
            return true; // Authentification réussie
        }

        return false; // Authentification échouée
    }

    public function getUserIdByUsername($username)
    {
        // Requête pour récupérer l'ID de l'utilisateur correspondant au nom d'utilisateur fourni.
        $query = "SELECT id FROM users WHERE username = :username";
        $statement = self::$pdo->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return $user['id']; // Retourne l'ID de l'utilisateur
        }

        return null; // Aucun utilisateur trouvé
    }

    public function getUserDataById($userId)
    {
        // Écrivez la requête SQL pour obtenir les données de l'utilisateur
        $query = "SELECT * FROM users WHERE id = :id";
        $statement = self::$pdo->prepare($query);
        $statement->bindParam(':id', $userId, PDO::PARAM_INT);
        $statement->execute();

        // Vérifiez si l'utilisateur existe
        if ($statement->rowCount() > 0) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        } else {
            return null; // Aucun utilisateur trouvé
        }
    }
}
