<?php

namespace audrey\CalendarApp\Model;

use Exception;
use PDO;
use audrey\CalendarApp\View\Partial\SingleCalendar;
use audrey\CalendarApp\Utility\Database;

class LessonModel
{
    // TODO: Pensez à bind params

    public static function getLessons()
    {
        $db = Database::connectPDO();
        $query = "SELECT id, name, is_hp, date_start, date_end FROM lesson";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'audrey\CalendarApp\Model\LessonModel');
        return $result;
    }

    public static function getLessonModule($idLesson)
    {
        $db = Database::connectPDO();
        $query = "SELECT color
        FROM module
        INNER JOIN lesson
        ON lesson.id_module = module.id
        WHERE lesson.id = $idLesson;
        ";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'audrey\CalendarApp\Model\LessonModel');
        return $result;
    }

    // TODO: function pour ajouter des lessons
    // public static function addLesson($date_start, $date_end, $name) {
    //     $db = Database::connectPDO();
    //     $query = "INSERT INTO lesson";
    // }

}
