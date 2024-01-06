<?php

namespace App\Models;

use App\Database;
use PDO;

class Logs{

    private static $pdo;

    public function __construct()
    {
        // Vérifier si l'instance de la connexion n'a pas déjà été créée, sinon la créer
        if (!self::$pdo) {
            self::$pdo = Database::connect();
        }
    }

    public function getLogs()
    {
        $sql = "SELECT * FROM logs ORDER BY id DESC";
        $query = self::$pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}