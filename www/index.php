<?php
//On génrère une constante qui contiendra le chemin vers index.php
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
die(ROOT);

$params = explode('/', $_GET['p']);

if($params[0] != ""){
    $controller = ucfirst($params[0]);
    echo $controller;
    $action = isset($params[1]) ? $params[1] : 'index';
    
    require_once(ROOT.'/controllers/'.$controller.'.php');

}else{

}

//var_dump($params);

//echo phpinfo();

echo '<br>Bienvenue sur la page d\'accueil !<br>';
$pdo = new PDO('mysql:host=mysql;dbname=thoms', 'thoms', 'password');

// try {
//         $pdo = new PDO('mysql:host=mysql;dbname=thoms', 'thoms', 'password');
//     } catch (PDOException $e) {
//         echo 'Erreur : ' . $e->getMessage() . '<br />';
//         echo 'N° : ' . $e->getCode();
//         die('Could not connect to MySQL');
//     }

$userStatement = $pdo->prepare("SELECT * FROM user");
$userStatement->execute();
$users = $userStatement->fetchAll();

foreach ($users as $user) {
    echo $user['name'] . '<br>';
}

?>