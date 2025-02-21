<?php

namespace audrey\CalendarApp\Controller;

use audrey\CalendarApp\Model\SingleView;
use audrey\CalendarApp\View\Partial\Home;
use audrey\CalendarApp\View\Layout\Header;
use audrey\CalendarApp\View\Layout\Footer;

class HomeController
{
    public function __construct(
        //* comment or oups.
        // public readonly array $args,
    ) {}

    public function execute()
    {
        $header = new Header();
        $view = new Home();
        $footer = new Footer();

        return
            $header->render() .
            $view->render() .
            $footer->render();
    }
}
