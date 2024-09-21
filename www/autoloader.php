<?php

namespace App;

class Autoloader
{
    static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
        session_start();
    }

    static function autoload($class)
    {
        // On retire le namespace racine du projet (App\)
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);
        $class = str_replace('\\', '/', $class); // Convertit les backslashes en slashes (pour les sous-répertoires)

        // Définissez le chemin racine du projet (vous pouvez ajuster cela si nécessaire)
        $rootDir = __DIR__;  // Récupère le dossier actuel qui est /var/www/html dans votre cas

        // Construit le chemin complet vers le fichier à partir du namespace
        $file = $rootDir . '/' . $class . '.php';

        if (file_exists($file)) {
            require $file;
        } else {
            // Déclenche une erreur si le fichier n'est pas trouvé
            throw new \Exception("Le fichier pour la classe {$class} n'a pas été trouvé à l'emplacement {$file}");
        }
    }
}
