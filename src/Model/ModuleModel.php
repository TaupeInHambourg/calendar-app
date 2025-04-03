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
            WHERE id_class=:id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $classe, PDO::PARAM_INT);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'audrey\CalendarApp\Model\ModuleModel');
        return $result;
    }

    // TODO: addModule
    public static function addModule($class, $session, $name, $description, $duration, $hours_attributed, $hours_allowed, $color, $is_option)
    {
        $db = Database::connectPDO();
        $query =
            "INSERT INTO lesson ('class', 'session', 'name', 'description', 'duration', 'hours_attributed', 'hours_allowed', 'color', 'is_option')
    VALUES (:classId, :sessionId, :lessonName, :lessonDescription, :lessonDuration, :hoursAttributed, :hoursAllowed, :lessonColor, :isOption)";

        $stmt = $db->prepare($query);

        $stmt->bindValue(':classId', $class, $class === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':sessionId', $session, $session === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':lessonName', $name, $name === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':lessonDescription', $description, $description === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':lessonDuration', $duration, $duration === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':hoursAttributed', $hours_attributed, $hours_attributed === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':hoursAllowed', $hours_allowed, $hours_allowed === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':lessonColor', $color, $color === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':isOption', $is_option, $is_option === null ? PDO::PARAM_NULL : PDO::PARAM_BOOL);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'audrey\CalendarApp\Model\ModuleModel');
        return $result;
    }
}
