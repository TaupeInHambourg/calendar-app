<?php

namespace audrey\CalendarApp\Controller;

use audrey\CalendarApp\View\Layout\Header;
use audrey\CalendarApp\View\Layout\Footer;
use audrey\CalendarApp\View\Partial\HomeView;

use audrey\CalendarApp\Model\GradeModel;
use audrey\CalendarApp\Model\LessonModel;
use audrey\CalendarApp\Model\ModuleModel;

class HomeController
{

    public function __construct(
        //* comment or oups.
        // public readonly array $args,
    ) {}

    public function execute()
    {
        $header = new Header();
        $view = new HomeView();
        $footer = new Footer();
        $grades = GradeModel::getGrades();
        $lessons = LessonModel::getLessons();
        $modules = ModuleModel::getModuleByClasse(8);
        $js = 'home';

        return
            $header->render() .
            $view->render($grades, $lessons, $modules) .
            $footer->render($js);
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
