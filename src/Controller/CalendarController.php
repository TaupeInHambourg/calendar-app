<?php

namespace audrey\CalendarApp\Controller;

use audrey\CalendarApp\View\Component\Header;
use audrey\CalendarApp\View\Component\Footer;
use audrey\CalendarApp\View\Partial\SingleCalendar;

use audrey\CalendarApp\Model\GradeModel;
use audrey\CalendarApp\Model\LessonModel;

class CalendarController
{

    public function __construct(
        //* comment or oups.
        // public readonly array $args,
    ) {}

    public function execute()
    {
        $header = new Header();
        $view = new SingleCalendar();
        $footer = new Footer();
        $grades = GradeModel::getGrades();
        $lessons = LessonModel::getLessons();

        return
            $header->render() .
            $view->render($grades, $lessons) .
            $footer->render();
    }


    // public function showCalendar()
    // {
    //     $month = isset($_GET['month']) ? $_GET['month'] : date('m');
    //     $year = isset($_GET['year']) ? $_GET['year'] : date('Y');

    //     $events = EventModel::getEventsForMonth($year, $month);

    //     // Inclure la vue avec les événements
    //     include 'views/partials/SingleCalendar.php';
    // }

    // public function addEvent()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $description = $_POST['description'];
    //         $day = $_POST['day'];
    //         $month = $_POST['month'];
    //         $year = $_POST['year'];

    //         EventModel::addEvent($year, $month, $day, $description);

    //         // Rediriger vers le calendrier
    //         header('Location: /calendar?month=' . $month . '&year=' . $year);
    //         exit();
    //     }
    // }
}
