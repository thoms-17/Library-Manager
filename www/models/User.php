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
    private $profile_image;
    private $role;
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
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }

    public function setProfileImage($profile_image)
    {
        $this->profile_image = $profile_image;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }

    public function save()
    {
        // Vérifier que l'utilisateur n'existe pas déjà dans la base de données
        if ($this->userExists($this->username, $this->email)) {
            throw new \Exception('L\'utilisateur existe déjà.');
        }

        // Préparation de la requête SQL avec des paramètres nommés
        $query = "INSERT INTO users (username, email, password, creation_date, profile_image) VALUES (:username, :email, :password, :creation_date, :profile_image)";
        $statement = self::$pdo->prepare($query);

        // Liaison des valeurs avec les paramètres
        $statement->bindValue(':username', $this->username);
        $statement->bindValue(':email', $this->email);
        $statement->bindValue(':password', $this->password);
        $statement->bindValue(':creation_date', $this->creation_date);
        $statement->bindValue(':profile_image', $this->profile_image, PDO::PARAM_LOB);

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
            // Enrregistrement de la connexion dans la table logs
            $this->logConnection($user['username'], 'Connexion réussie', $user['id']);
            return true; // Authentification réussie
        }

        $this->logConnection($username, 'Tentative de connexion échouée');
        return false; // Authentification échouée
    }

    public function getUserDataByUsername($username)
    {
        // Requête pour récupérer l'ID et le rôle de l'utilisateur correspondant au nom d'utilisateur fourni.
        $query = "SELECT * FROM users WHERE username = :username";
        $statement = self::$pdo->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();

        $userData = $statement->fetch(PDO::FETCH_ASSOC);

        return $userData; // Retourne un tableau associatif contenant l'ID et le rôle de l'utilisateur
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM users";
        $statement = self::$pdo->prepare($query);
        $statement->execute();

        $usersData = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $usersData;
    }

    public function logConnection($username, $action, $userId = null)
    {
        $query = "INSERT INTO logs (user_id, username, action) VALUES (:user_id, :username, :action)";
        $statement = self::$pdo->prepare($query);

        // Utilisez la valeur de $userId si elle est fournie, sinon, laissez NULL
        $statement->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':action', $action);

        $statement->execute();
    }
}
