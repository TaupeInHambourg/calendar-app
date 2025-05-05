<?php

namespace audrey\CalendarApp\Controller;

use audrey\CalendarApp\Model\LessonModel;
use audrey\CalendarApp\Model\ModuleModel;

class DragDropController
{
  public function __construct()
  {
    // Ensure this is an AJAX request
    header('Content-Type: application/json');
    try {
      $this->handleDragDrop();
    } catch (\Exception $e) {
      $this->sendResponse(500, ['error' => 'Internal server error DnD']);
    }
  }

  public function handleDragDrop()
  {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      $this->sendResponse(405, ['error' => 'Method not allowed']);
      return;
    }

    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
      error_log("Invalid JSON received");
      $this->sendResponse(400, ['error' => 'Invalid JSON']);
      return;
    }

    if (!isset($data['action'])) {
      error_log("Missing action parameter");
      $this->sendResponse(400, ['error' => 'Missing action parameter']);
      return;
    }

    error_log("Action: " . $data['action']);

    switch ($data['action']) {
      case 'moveLesson':
        $this->moveLesson($data);
        break;
      case 'createLesson':
        $this->createLesson($data);
        break;
      default:
        error_log("Invalid action: " . $data['action']);
        $this->sendResponse(400, ['error' => 'Invalid action']);
    }
  }

  private function moveLesson($data)
  {
    if (!isset($data['lessonId']) || !isset($data['newDate'])) {
      $this->sendResponse(400, ['error' => 'Missing required parameters']);
      return;
    }

    try {
      $this->handleDragDrop();
    } catch (\Exception $e) {
      $this->sendResponse(500, ['error' => 'Internal server error DnD', 'message' => $e->getMessage()]);
    }
  }

  private function createLesson($data)
  {
    if (!isset($data['moduleId']) || !isset($data['date'])) {
      $this->sendResponse(400, ['error' => 'Missing required parameters']);
      return;
    }

    $newLessonId = LessonModel::createLessonFromModule($data['moduleId'], $data['dateStart'], $data['dateEnd']);

    if ($newLessonId) {
      $lessons = LessonModel::getLessons();
      $newLesson = null;

      foreach ($lessons as $lesson) {
        if ($lesson->id == $newLessonId) {
          $newLesson = $lesson;
          break;
        }
      }

      $this->sendResponse(201, [
        'success' => true,
        'lessonId' => $newLessonId,
        'lesson' => $newLesson
      ]);
    } else {
      $this->sendResponse(500, ['error' => 'Failed to create lesson']);
    }
  }

  private function sendResponse($statusCode, $data)
  {
    http_response_code($statusCode);
    echo json_encode($data);
  }
}
