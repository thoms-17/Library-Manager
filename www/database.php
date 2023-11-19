<?php

namespace App;

use PDO;

class Database
{
    public static function connect()
    {
        // Charger les variables du fichier .env
        $envVariables = parse_ini_file(__DIR__ . '/.env');

        // Informations de connexion à la base de données MySQL à partir du fichier .env
        $dbHost = $envVariables['DB_HOST'];
        $dbName = $envVariables['DB_NAME'];
        $dbUser = $envVariables['DB_USER'];
        $dbPass = $envVariables['DB_PASS'];

        // Initialise la connexion à la base de données en utilisant PDO
        $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8";

        try {
            $pdo = new PDO($dsn, $dbUser, $dbPass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //echo 'Connexion à la base de données réussie ! ';
            // Retourner l'instance de PDO pour être utilisée dans les autres parties de l'application
            return $pdo;
        } catch (PDOException $e) {
            // En cas d'erreur de connexion, afficher le message d'erreur
            echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
            return null;
        }
    }
}
