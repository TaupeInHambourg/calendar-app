<?php

namespace audrey\CalendarApp\View\Partial;

use audrey\CalendarApp\Model\LessonModel;
use audrey\CalendarApp\View\Component\ModuleComponent;

class SingleCalendar
{
    public static function render($grades, $lessons)
    {
        $currentMonth = isset($_GET['month']) ? intval($_GET['month']) : date('n');
        $currentYear = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

        if ($currentMonth < 1) {
            $currentMonth = 12;
            $currentYear--;
        } elseif ($currentMonth > 12) {
            $currentMonth = 1;
            $currentYear++;
        }

        $firstDayOfMonth = new \DateTime("$currentYear-$currentMonth-01");
        $daysInMonth = $firstDayOfMonth->format('t');
        $startDay = $firstDayOfMonth->format('N') - 1; // 0 for Monday, 1 for Tuesday, etc.

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

        $modules = [
            ['name' => 'Développement SQL - noSQL', 'attributed' => 2, 'allowed' => 2, 'color' => '#f87171'],
            ['name' => 'Framework CSS', 'attributed' => 0, 'allowed' => 2, 'color' => '#fbbf24'],
            ['name' => 'Framework CSS', 'attributed' => 2, 'allowed' => 1, 'color' => '#34d399'],
            ['name' => 'Développement SQL - noSQL', 'attributed' => 2, 'allowed' => 2, 'color' => '#f87171'],
            ['name' => 'Framework CSS', 'attributed' => 2, 'allowed' => 1, 'color' => '#34d399'],
            ['name' => 'Framework CSS', 'attributed' => 2, 'allowed' => 1, 'color' => '#34d399'],
        ];

        $weekNumbers = [];
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = new \DateTime("$currentYear-$currentMonth-$day");
            $weekNumbers[$day] = $date->format('W');
        }

        // Calculate the weeks for the month
        $weeksInMonth = [];
        $currentWeek = null;

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = new \DateTime("$currentYear-$currentMonth-$day");
            $weekNumber = $date->format('W');

            if ($currentWeek !== $weekNumber) {
                $currentWeek = $weekNumber;
                $weeksInMonth[] = $currentWeek;
            }
        }
?>
        <div class="container mx-auto p-6">
            <div class="flex justify-between items-center">
                <a href="?month=<?= $currentMonth - 1 ?>&year=<?= $currentYear ?>" class="px-4 py-2 bg-gray-300 rounded-lg text-lg">Précédent</a>
                <h2 class="text-2xl font-bold"><?= $monthName . ' ' . $currentYear ?></h2>
                <a href="?month=<?= $currentMonth + 1 ?>&year=<?= $currentYear ?>" class="px-4 py-2 bg-gray-300 rounded-lg text-lg">Suivant</a>
                <button onclick="toggleModules()" class="px-4 py-2 bg-gray-300 rounded-lg text-lg">👁️</button>
            </div>

            <div class="flex mt-6">
                <!-- Calendar Grid -->
                <div class="grid grid-cols-5 gap-4 w-11/12">
                    <div class="text-center font-semibold">Lun</div>
                    <div class="text-center font-semibold">Mar</div>
                    <div class="text-center font-semibold">Mer</div>
                    <div class="text-center font-semibold">Jeu</div>
                    <div class="text-center font-semibold">Ven</div>

                    <!-- Grey out days before the first day of the month -->
                    <?php for ($i = 0; $i < $startDay; $i++): ?>
                        <div class="min-h-fit bg-gray-200 rounded-lg"></div>
                    <?php endfor; ?>

                    <?php for ($day = 1; $day <= $daysInMonth; $day++): ?>
                        <?php
                        $currentMonthStr = str_pad($currentMonth, 2, '0', STR_PAD_LEFT);
                        $dayStr = str_pad($day, 2, '0', STR_PAD_LEFT);
                        $eventDateKey = "$currentYear-$currentMonthStr-$dayStr";
                        $events = [];

                        foreach ($lessons as $lesson) {
                            $lessonDateKey = explode(" ", $lesson->date_start)[0];
                            if ($lessonDateKey === $eventDateKey) {
                                $events[] = $lesson;
                            }
                        }

                        $dateObj = new \DateTime($eventDateKey);
                        $dayOfWeek = $dateObj->format('N') - 1;

                        // Skip Saturday and Sunday
                        if ($dayOfWeek >= 5) {
                            continue;
                        }
                        ?>
                        <div class="min-h-fit bg-white rounded-lg relative p-2 hover:bg-gray-100">
                            <div class="font-semibold text-center">
                                <?= $day ?>
                            </div>
                            <div class="event-list p-1 mt-2 bg-gray-100 rounded-lg overflow-y-auto min-h-fit">
                                <?php foreach ($events as $event): ?>
                                    <div class="text-sm bg-[<?= LessonModel::getLessonModule($event->id)[0]->color; ?>] rounded p-1 mt-1">
                                        <?= htmlspecialchars($event->name) ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endfor; ?>

                    <!-- Add empty cells to complete the grid for the remaining days of the week -->
                    <?php
                    $endDay = (new \DateTime("$currentYear-$currentMonth-$daysInMonth"))->format('N') - 1;
                    for ($i = $endDay; $i < 5; $i++) {
                        echo '<div class="min-h-fit bg-gray-200 rounded-lg"></div>';
                    }
                    ?>
                </div>

                <!-- Week Numbers Column -->
                <div class="ml-4 w-1/12">
                    <h3 class="text-xl font-semibold mb-4">Semaine</h3>
                    <?php foreach ($weeksInMonth as $weekNumber): ?>
                        <div class="min-h-fit bg-white rounded-lg relative p-2 mb-2">
                            <div class="font-semibold text-center">
                                <small>Semaine <?= $weekNumber ?></small>
                            </div>
                            <input type="checkbox" id="hp_week_<?= $weekNumber ?>" class="mr-1">
                            <label for="hp_week_<?= $weekNumber ?>">dans HP</label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div id="modules" class="hidden mt-6">
                <?php ModuleComponent::render($modules); ?>
            </div>
        </div>

        <script>
            function toggleModules() {
                const modules = document.getElementById('modules');
                modules.classList.toggle('hidden');
            }
        </script>
<?php
    }
}
