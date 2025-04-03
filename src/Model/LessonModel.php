<?php

namespace audrey\CalendarApp\Model;

use Exception;
use PDO;
use audrey\CalendarApp\View\Partial\SingleCalendar;
use audrey\CalendarApp\Utility\Database;

class LessonModel
{
    // private $id;

    public static function getLessons()
    {
        $db = Database::connectPDO();
        $query = "SELECT id, name, is_hp, date_start, date_end FROM lesson";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'audrey\CalendarApp\Model\LessonModel');
        return $result;
    }

    public static function getLessonColor(int $idLesson)
    {
        $db = Database::connectPDO();
        $query = "SELECT color
        FROM module
        INNER JOIN lesson
        ON lesson.id_module = module.id
        WHERE lesson.id = :id;
        ";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $idLesson, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'audrey\CalendarApp\Model\LessonModel');
        return $result;
    }

    public static function addLesson($name, $is_hp, $date_start, $date_end)
    {
        $db = Database::connectPDO();
        $query =
            "INSERT INTO lesson ('name', 'is_hp', 'date_start', 'date_end')
        VALUES (:name, :is_hp, :date_start, :date_end)
        ";
        $stmt = $db->prepare($query);

        //TODO: Gestion des param null + passer les params par le controller
        $stmt->bindValue(':name', $name, $name === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':is_hp', $is_hp, $is_hp === null ? PDO::PARAM_NULL : PDO::PARAM_BOOL);
        $stmt->bindValue(':date_start', $date_start, $date_start === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':date_end', $date_end, $date_end === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'audrey\CalendarApp\Model\LessonModel');
        return $result;
    }

    public static function updateLesson($lesson, $name, $is_hp, $date_start, $date_end)
    {
        $db = Database::connectPDO();
        $query =
            "UPDATE `lesson`
            SET `name` = :name,
                `is_hp` = :is_hp,
                `date_start` = :date_start,
                `date_end` = :date_end
            WHERE id = :lesson";
        $stmt = $db->prepare($query);

        //TODO: Gestion des param null + passer les params par le controller
        $stmt->bindValue(':name', $name, $name === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':is_hp', $is_hp, $is_hp === null ? PDO::PARAM_NULL : PDO::PARAM_BOOL);
        $stmt->bindValue(':date_start', $date_start, $date_start === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':date_end', $date_end, $date_end === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':id', $lesson, PDO::PARAM_INT);
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'audrey\CalendarApp\Model\LessonModel');
        return $result;
    }
}
