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
        $this->password = $password;
    }

    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
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
        $statement->execute();

        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        return $result['count'] > 0;
    }

    public function authenticate($username, $password)
    {
        try {

            $stmt = self::$pdo->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            die("Erreur SQL dans authenticate(): " . $e->getMessage());
        }
    }

    public function getUserDataByUsername($username)
    {
        try {
            $stmt = self::$pdo->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            return $user ?: null;
        } catch (PDOException $e) {
            die("Erreur SQL dans getUserDataByUsername(): " . $e->getMessage());
        }
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

    public function deleteUser($userId, $password)
    {
        // Récupérer les informations de l'utilisateur
        $userData = $this->getUserDataById($userId);

        // Vérifier si le mot de passe est correct
        if (password_verify($password, $userData['password'])) {
            // Supprimer le compte
            $query = "DELETE FROM users WHERE id = :user_id";
            $statement = self::$pdo->prepare($query);
            $statement->bindValue(':user_id', $userId, PDO::PARAM_INT);
            $statement->execute();

            return true; // Suppression réussie
        }
        return false; // Mot de passe incorrect
    }

    // Ajoutez également une méthode pour récupérer les informations de l'utilisateur par ID
    public function getUserDataById($userId)
    {
        $query = "SELECT * FROM users WHERE id = :user_id";
        $statement = self::$pdo->prepare($query);
        $statement->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUserInfo($userId, $username, $imageData = null)
    {
        var_dump($username);
        $query = "UPDATE users SET username = :username";
        if ($imageData) {
            $query .= ", profile_image = :profile_image";
        }
        $query .= " WHERE id = :user_id";

        $statement = self::$pdo->prepare($query);
        $statement->bindValue(':username', $username, PDO::PARAM_STR);
        if ($imageData) {
            $statement->bindValue(':profile_image', $imageData, PDO::PARAM_LOB);
        }
        $statement->bindValue(':user_id', $userId, PDO::PARAM_INT);

        return $statement->execute();
    }
}
