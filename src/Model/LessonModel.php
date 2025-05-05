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

    public static function getLessonById(int $idLesson)
    {
        $db = Database::connectPDO();
        $query = "SELECT id, name, id_module, date_start, date_end 
                      FROM lesson WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $idLesson, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'audrey\CalendarApp\Model\LessonModel');
        return !empty($result) ? $result[0] : null;
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

    public static function updateLessonDate($lessonId, $newDate)
    {
        $db = Database::connectPDO();
        $query = "UPDATE lesson SET date_start = :newDate WHERE id = :lessonId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':lessonId', $lessonId, PDO::PARAM_INT);
        $stmt->bindParam(':newDate', $newDate, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public static function createLessonFromModule($moduleId, $date)
    {
        $db = Database::connectPDO();

        // First get module details
        $moduleQuery = "SELECT name, duration FROM module WHERE id = :moduleId";
        $moduleStmt = $db->prepare($moduleQuery);
        $moduleStmt->bindParam(':moduleId', $moduleId, PDO::PARAM_INT);
        $moduleStmt->execute();
        $module = $moduleStmt->fetch(PDO::FETCH_ASSOC);

        // Calculate end date based on duration
        $startDate = new \DateTime($date);
        $endDate = clone $startDate;
        $endDate->modify('+' . $module['duration'] . ' hours');

        $startDateStr = $startDate->format('Y-m-d H:i:s');
        $endDateStr = $endDate->format('Y-m-d H:i:s');

        // Insert new lesson
        $query = "INSERT INTO lesson (name, id_module, date_start, date_end) 
              VALUES (:name, :moduleId, :dateStart, :dateEnd)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $module['name'], PDO::PARAM_STR);
        $stmt->bindParam(':moduleId', $moduleId, PDO::PARAM_INT);
        $stmt->bindParam(':dateStart', $startDateStr, PDO::PARAM_STR);
        $stmt->bindParam(':dateEnd', $endDateStr, PDO::PARAM_STR);

        $stmt->execute();
        return $db->lastInsertId();
    }

    // public static function updateLesson($lesson, $date_start, $date_end)
    // {
    //     $db = Database::connectPDO();
    //     $query =
    //         "UPDATE `lesson`
    //         SET `date_start` = :date_start,
    //             `date_end` = :date_end
    //         WHERE id = :lesson";
    //     $stmt = $db->prepare($query);

    //     $stmt->bindValue(':date_start', $date_start, $date_start === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
    //     $stmt->bindValue(':date_end', $date_end, $date_end === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
    //     $stmt->bindValue(':id', $lesson, PDO::PARAM_INT);
    //     $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'audrey\CalendarApp\Model\LessonModel');
    //     return $result;
    // }

    public function createLesson()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Méthode non autorisée']);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['moduleId']) || !isset($data['dateStart']) || !isset($data['dateEnd'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Données manquantes']);
            return;
        }

        // Récupérer les informations du module
        $db = Database::connectPDO();
        $moduleQuery = "SELECT name FROM module WHERE id = :id";
        $moduleStmt = $db->prepare($moduleQuery);
        $moduleStmt->bindParam(':id', $data['moduleId'], \PDO::PARAM_INT);
        $moduleStmt->execute();
        $module = $moduleStmt->fetch(\PDO::FETCH_ASSOC);

        if (!$module) {
            http_response_code(404);
            echo json_encode(['error' => 'Module non trouvé']);
            return;
        }

        // Insérer la nouvelle leçon
        $query = "INSERT INTO lesson (name, id_module, is_hp, date_start, date_end) 
                  VALUES (:name, :moduleId, 0, :dateStart, :dateEnd)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $module['name'], \PDO::PARAM_STR);
        $stmt->bindParam(':moduleId', $data['moduleId'], \PDO::PARAM_INT);
        $stmt->bindParam(':dateStart', $data['dateStart'], \PDO::PARAM_STR);
        $stmt->bindParam(':dateEnd', $data['dateEnd'], \PDO::PARAM_STR);

        if ($stmt->execute()) {
            $newId = $db->lastInsertId();
            echo json_encode([
                'success' => true,
                'id' => $newId,
                'message' => 'Leçon créée avec succès'
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erreur lors de la création de la leçon']);
        }
    }

    // public function updateLesson($id)
    // {
    //     if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    //         http_response_code(405);
    //         echo json_encode(['error' => 'Méthode non autorisée']);
    //         return;
    //     }

    //     $data = json_decode(file_get_contents('php://input'), true);

    //     if (!isset($data['dateStart']) || !isset($data['dateEnd'])) {
    //         http_response_code(400);
    //         echo json_encode(['error' => 'Données manquantes']);
    //         return;
    //     }

    //     $db = Database::connectPDO();
    //     $query = "UPDATE lesson SET date_start = :dateStart, date_end = :dateEnd WHERE id = :id";
    //     $stmt = $db->prepare($query);
    //     $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
    //     $stmt->bindParam(':dateStart', $data['dateStart'], \PDO::PARAM_STR);
    //     $stmt->bindParam(':dateEnd', $data['dateEnd'], \PDO::PARAM_STR);

    //     if ($stmt->execute()) {
    //         echo json_encode([
    //             'success' => true,
    //             'message' => 'Leçon mise à jour avec succès'
    //         ]);
    //     } else {
    //         http_response_code(500);
    //         echo json_encode(['error' => 'Erreur lors de la mise à jour de la leçon']);
    //     }
    // }
}
