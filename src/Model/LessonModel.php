<?php

namespace audrey\CalendarApp\Model;

use Exception;
use PDO;
use audrey\CalendarApp\View\Partial\SingleCalendar;
use audrey\CalendarApp\Utility\Database;

class LessonModel
{

    public static function getLessons()
    {
        $db = Database::connectPDO();
        $query = "SELECT id, name, is_hp, date_start, date_end FROM lesson";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'audrey\CalendarApp\Model\LessonModel');
        return $result;
    }

    public static function getLessonColor($idLesson)
    {
        $db = Database::connectPDO();
        $query = "SELECT color
        FROM module
        INNER JOIN lesson
        ON lesson.id_module = module.id
        WHERE lesson.id = ?;
        ";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $idLesson, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'audrey\CalendarApp\Model\LessonModel');
        return $result;
    }

    public static function addLesson($name, $is_hp, $date_start, $date_end)
    {
        $db = Database::connectPDO();
        $query =
            "INSERT INTO lesson ('name', 'is_hp', 'date_start', 'date_end')
        VALUES (?, ?, ?, ?)
        ";
        $stmt = $db->prepare($query);

        //TODO: Gestion des param null
        $stmt->bindParam(1, $name, PDO::PARAM_STR);
        $stmt->bindParam(2, $is_hp, PDO::PARAM_BOOL);
        $stmt->bindParam(3, $date_start, PDO::PARAM_STR);
        $stmt->bindParam(4, $date_end, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'audrey\CalendarApp\Model\LessonModel');
        return $result;
    }
}
