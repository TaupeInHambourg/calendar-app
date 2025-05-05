<?php

namespace audrey\CalendarApp\Controller;

use audrey\CalendarApp\View\Layout\Header;
use audrey\CalendarApp\View\Layout\Footer;
use audrey\CalendarApp\View\Partial\HomeView;

use audrey\CalendarApp\Model\GradeModel;
use audrey\CalendarApp\Model\LessonModel;
use audrey\CalendarApp\Model\ModuleModel;
use Exception;

class HomeController
{
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
}
