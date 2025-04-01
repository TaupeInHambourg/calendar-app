<?php

namespace audrey\CalendarApp\Model;

use Exception;
use PDO;
use audrey\CalendarApp\View\Partial\SingleCalendar;
use audrey\CalendarApp\Utility\Database;

class ModuleModel
{
    // TODO: Pensez à bind params

    public static function getModules()
    {
        $db = Database::connectPDO();
        $query = "SELECT id, id_class, id_session, name, description, duration,hours_attributed, hours_allowed, color, is_option FROM module";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'audrey\CalendarApp\Model\ModuleModel');
        return $result;
    }

    public static function getModuleByClasse($classe)
    {
        $db = Database::connectPDO();
        $query =
            "SELECT id, id_class, id_session, name, description, duration,hours_attributed, hours_allowed, color, is_option 
            FROM module
            WHERE id_class=?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $classe, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'audrey\CalendarApp\Model\ModuleModel');
        return $result;
    }
}
