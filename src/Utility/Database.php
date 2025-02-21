<?php

namespace audrey\CalendarApp\Utility;
use PDO;
use Exception;

class Database {
    private $dsn;
    private static $_instance;

    private function __construct()
    {
        $configData = parse_ini_file('config.ini');

        try {
            $this->dsn = new PDO(
                "mysql:host={$configData['DB_HOST']};dbname={$configData['DB_NAME']};charset=utf8",
                $configData['DB_USERNAME'],
                $configData['DB_PASSWORD']           
            );
        } catch (Exception $exception) {            
            // En cas d'échec de la connexion, affichage de l'erreur et arrêt du script
            echo $exception->getMessage() . '<br> T\'es pas co mon chat :\'(<br>';                                    
            die;
        }
    }    

    // Méthode statique pour récupérer l'instance de connexion PDO
    public static function connectPDO()
    {        
        // Vérification si une instance existe déjà, sinon en crée une nouvelle
        if (empty(self::$_instance)) {
            self::$_instance = new DataBase();
        }
        // Retourne l'objet PDO pour la connexion à la base de données
        return self::$_instance->dsn;
    }
}