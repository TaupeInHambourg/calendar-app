<?php

namespace audrey\CalendarApp\Controller;

use audrey\CalendarApp\Model\LessonModel;

class LessonController
{

  public function getLesson($id)
  {
    header('Content-Type: application/json');

    $lesson = LessonModel::getLessonById($id);

    if (!empty($lesson)) {
      echo json_encode($lesson);
    } else {
      http_response_code(404);
      echo json_encode(['error' => 'Lesson not found']);
    }
  }

  public function getLessonColor($lesson)
  {
    header('Content-Type: application/json');

    $color = LessonModel::getLessonColor($lesson);

    if (!empty($color)) {
      echo json_encode(['color' => $color[0]->color]);
    } else {
      http_response_code(404);
      echo json_encode(['error' => 'Lesson color not found']);
    }
  }

  public function updateLesson($lesson)
  {
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      http_response_code(405);
      echo json_encode(['error' => 'Méthode non autorisée']);
      return;
    }

    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['dateStart']) || !isset($data['dateEnd'])) {
      http_response_code(400);
      echo json_encode(['error' => 'Données manquantes']);
      return;
    }

    try {
      // Extraction de la date de début pour la méthode updateLessonDate
      $dateStart = new \DateTime($data['dateStart']);
      $formattedDateStart = $dateStart->format('Y-m-d H:i:s');

      // Met à jour la date de début de la leçon
      $success = LessonModel::updateLessonDate($data['lessonId'], $formattedDateStart);

      // TODO: Implémenter la mise à jour de la date de fin au besoin

      if ($success) {
        echo json_encode(['success' => true]);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to update lesson']);
      }
    } catch (\Exception $e) {
      http_response_code(500);
      echo json_encode(['error' => 'Internal server error', 'message' => $e->getMessage()]);
    }
  }

  public function createLesson()
  {
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      http_response_code(405);
      echo json_encode(['error' => 'Method not allowed']);
      return;
    }

    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['moduleId']) || !isset($data['dateStart']) || !isset($data['dateEnd'])) {
      http_response_code(400);
      echo json_encode(['error' => 'Missing required parameters']);
      return;
    }

    try {
      // TODO: Implémenter la création d'une leçon à partir d'un module
      $newLessonId = LessonModel::createLessonFromModule($data['moduleId'], $data['dateStart']);

      if ($newLessonId) {
        $lessons = LessonModel::getLessons();
        $newLesson = null;

        foreach ($lessons as $lesson) {
          if ($lesson->id == $newLessonId) {
            $newLesson = $lesson;
            break;
          }
        }

        http_response_code(201);
        echo json_encode([
          'success' => true,
          'id' => $newLessonId,
          'lesson' => $newLesson
        ]);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to create lesson']);
      }
    } catch (\Exception $e) {
      http_response_code(500);
      echo json_encode(['error' => 'Internal server error', 'message' => $e->getMessage()]);
    }
  }
}
