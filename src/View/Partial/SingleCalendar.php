<?php

namespace audrey\CalendarApp\View\Partial;

use audrey\CalendarApp\Model\LessonModel;
use audrey\CalendarApp\View\Component\LessonComponent;
use audrey\CalendarApp\View\Component\ModuleComponent;

class SingleCalendar
{
    public static function render($grades, $lessons, $modules)
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
        <div class="container flex justify-between min-w-full">
            <div class="w-11/12">
                <div class="flex justify-between items-center my-8">
                    <a href="?month=<?= $currentMonth - 1 ?>&year=<?= $currentYear ?>" class="px-4 py-2 bg-fjord-400 text-bone-50 rounded-lg text-lg hover:bg-fjord-500">Précédent</a>
                    <h2 class="text-2xl font-bold"><?= $monthName . ' ' . $currentYear ?></h2>
                    <a href="?month=<?= $currentMonth + 1 ?>&year=<?= $currentYear ?>" class="px-4 py-2 bg-fjord-400 text-bone-50 rounded-lg text-lg hover:bg-fjord-500">Suivant</a>
                </div>

                <div class="flex pt-8">
                    <!-- Calendar Grid -->
                    <div id="calendar-section" class="grid grid-cols-5 gap-4 w-11/12">
                        <div class="text-center font-semibold">Lun</div>
                        <div class="text-center font-semibold">Mar</div>
                        <div class="text-center font-semibold">Mer</div>
                        <div class="text-center font-semibold">Jeu</div>
                        <div class="text-center font-semibold">Ven</div>

                        <!-- Grey out days before the first day of the month -->
                        <?php if ($startDay != 5) for ($i = 0; $i < $startDay; $i++): ?>
                            <div class="min-h-fit bg-bone-100 rounded-lg"></div>
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
                            <div class="calendar min-h-16 bg-bone-50 rounded-lg relative p-2 hover:bg-bone-100">
                                <div class="day font-semibold text-center">
                                    <?= $day ?>
                                </div>
                                <?php foreach ($events as $event)
                                    LessonComponent::render($event);
                                ?>
                            </div>
                        <?php endfor; ?>

                        <!-- Add empty cells to complete the grid for the remaining days of the week -->
                        <?php
                        $endDay = (new \DateTime("$currentYear-$currentMonth-$daysInMonth"))->format('N') - 1;
                        for ($i = $endDay; $i < 5; $i++) {
                            echo '<div class="min-h-fit bg-bone-100 rounded-lg"></div>';
                        }
                        ?>
                    </div>

                    <!-- Week Numbers Column -->
                    <div class="ml-4 w-1/12">
                        <h3 class="text-xl font-semibold mb-4">Semaine</h3>
                        <?php foreach ($weeksInMonth as $weekNumber): ?>
                            <div class="min-h-fit bg-white rounded-lg relative p-2 mb-2">
                                <div class="font-semibold text-left">
                                    <small>Semaine <?= $weekNumber ?></small>
                                </div>
                                <input type="checkbox" id="hp_week_<?= $weekNumber ?>" class="mr-1">
                                <label for="hp_week_<?= $weekNumber ?>">dans HP</label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="w-fit flex flex-col">
                <button onclick="toggleModules(this)" class="px-4 py-3 bg-fjord-400 rounded-lg text-lg hover:bg-fjord-500 ml-auto  my-8">
                    <img id="eyeIcon" src="src/assets/icons/eye-opened-fill.svg" alt="Toggle visibility">
                </button>
                <div id="modules_section" class="hidden bg-bone-50 p-4 rounded pt-8">
                    <?php
                    ModuleComponent::render($modules);
                    ?>
                </div>
            </div>
        </div>

        <script>
            function toggleModules(button) {
                const modules = document.getElementById('modules_section');
                modules.classList.toggle('hidden');

                const icon = button.querySelector('#eyeIcon');
                if (icon.src.includes('eye-opened-fill.svg')) {
                    icon.src = 'src/assets/icons/eye-closed-outline.svg';
                } else {
                    icon.src = 'src/assets/icons/eye-opened-fill.svg';
                }

                const calendarWrapper = document.querySelector('.container div:first-of-type')
                if (calendarWrapper.classList.contains('w-11/12')) {
                    calendarWrapper.classList.replace('w-11/12', 'w-4/5')
                } else {
                    calendarWrapper.classList.replace('w-4/5', 'w-11/12')
                }

                const modulesWrapper = document.querySelector('.container div:last-of-type')
                if (modulesWrapper.classList.contains('w-fit')) {
                    modulesWrapper.classList.replace('w-fit', 'w-1/5')
                } else {
                    modulesWrapper.classList.replace('w-1/5', 'w-fit')
                }


            }
        </script>
<?php
    }
}
