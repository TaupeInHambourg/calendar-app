<?php

namespace audrey\CalendarApp\View\Partial;

use audrey\CalendarApp\Model\LessonModel;

class SingleCalendar
{
    public static function render($grades, $lessons)
    {
        // Obtenir la date actuelle
        $currentMonth = isset($_GET['month']) ? intval($_GET['month']) : date('n');
        $currentYear = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

        // Gérer le changement de mois
        if ($currentMonth < 1) {
            $currentMonth = 12;
            $currentYear--;
        } elseif ($currentMonth > 12) {
            $currentMonth = 1;
            $currentYear++;
        }

        // Obtenir le premier jour et le nombre de jours du mois
        $firstDayOfMonth = new \DateTime("$currentYear-$currentMonth-01");
        $daysInMonth = $firstDayOfMonth->format('t');
        // 'w' : first day = dimanche => -1 = lundi
        $startDay = $firstDayOfMonth->format('w') - 1;

        $months = [
            1 => 'Janvier',
            'Février',
            'Mars',
            'Avril',
            'Mai',
            'Juin',
            'Juillet',
            'Août',
            'Septembre',
            'Octobre',
            'Novembre',
            'Décembre'
        ];
        $monthName = $months[$currentMonth];

?>
        <div class="container mx-auto p-6">
            <div class="flex justify-between items-center">
                <a href="?month=<?= $currentMonth - 1 ?>&year=<?= $currentYear ?>" class="px-4 py-2 bg-gray-300 rounded-lg text-lg">Précédent</a>
                <h2 class="text-2xl font-bold"><?= $monthName . ' ' . $currentYear ?></h2>
                <a href="?month=<?= $currentMonth + 1 ?>&year=<?= $currentYear ?>" class="px-4 py-2 bg-gray-300 rounded-lg text-lg">Suivant</a>
            </div>

            <div class="grid grid-cols-7 gap-4 mt-6">
                <div class="text-center font-semibold">Lun</div>
                <div class="text-center font-semibold">Mar</div>
                <div class="text-center font-semibold">Mer</div>
                <div class="text-center font-semibold">Jeu</div>
                <div class="text-center font-semibold">Ven</div>
                <div class="text-center font-semibold">Sam</div>
                <div class="text-center font-semibold">Dim</div>

                <!-- Les jours du mois -->
                <?php
                // Ajouter des cases vides avant le premier jour du mois
                for ($i = 0; $i < $startDay; $i++) {
                    echo '<div class="min-h-fit bg-gray-200 rounded-lg"></div>';
                }

                // Ajouter les jours du mois
                for ($day = 1; $day <= $daysInMonth; $day++) {
                    strval($currentMonth);
                    strval($day);
                    if (strlen($currentMonth) < 2) {
                        $currentMonth = "0$currentMonth";
                    }
                    if (strlen($day) < 2) {
                        $day = "0$day";
                    }
                    $eventDateKey = "$currentYear-$currentMonth-$day";

                    for ($k = 0; $k < count($lessons); $k++) {
                        $lessonDateKey = explode(" ", $lessons[$k]->date_start);
                        $lessonColor = LessonModel::getLessonModule($lessons[$k]->id);

                        if ($lessonDateKey[0] === $eventDateKey) {
                            $events = array_filter($lessons, function ($lesson) use ($eventDateKey) {
                                return strpos($lesson->date_start, $eventDateKey) === 0;
                            });
                        }
                    }


                ?>
                    <div class=" min-h-fit bg-white rounded-lg relative p-2 hover:bg-gray-100">
                        <div class="font-semibold text-center"><?= $day ?></div>
                        <div class="event-list p-1 mt-2 bg-gray-100 rounded-lg overflow-y-auto min-h-fit">
                            <?php foreach ($events as $event): ?>
                                <div class="text-sm bg-[<?= $lessonColor[0]->color; ?>] rounded p-1 mt-1">
                                    <?= htmlspecialchars($event->name) ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
<?php
    }
}

// $instance = new SingleCalendar();
// $instance->render($grades, $lessons);
