<?php

namespace audrey\CalendarApp\Model;

use Exception;
use PDO;
use audrey\CalendarApp\View\Partial\SingleCalendar;
use audrey\CalendarApp\Utility\Database;

class GradeModel
{
    private int $id;
    private string $name;

    public static function getGrades(): array
    {
        $pdo = Database::connectPDO();
        $query = $pdo->prepare('SELECT * FROM grade');
        $query->execute();

        $calendar = $query->fetchAll(PDO::FETCH_CLASS, 'audrey\CalendarApp\Model\GradeModel');
        return $calendar;
    }

    public static function render($data)
    {
        return new SingleCalendar($data);
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
