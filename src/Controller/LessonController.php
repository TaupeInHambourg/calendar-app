<?php

namespace audrey\CalendarApp\Controller;

use audrey\CalendarApp\Model\LessonModel;

class LessonController
{
  // Autres méthodes...

  public function getLesson($id)
  {
    // Définir l'en-tête pour indiquer que la réponse est du JSON
    header('Content-Type: application/json');

    // Récupérer les données de la leçon depuis le modèle
    $lesson = LessonModel::getLessonById($id);

    if (!empty($lesson)) {
      echo json_encode($lesson);
    } else {
      http_response_code(404);
      echo json_encode(['error' => 'Lesson not found']);
    }
  }

  public function getLessonColor($lessonId)
  {
    header('Content-Type: application/json');

    $color = LessonModel::getLessonColor($lessonId);

    if (!empty($color)) {
      echo json_encode(['color' => $color[0]->color]);
    } else {
      http_response_code(404);
      echo json_encode(['error' => 'Lesson color not found']);
    }
  }
}
