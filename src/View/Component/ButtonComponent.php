<?php

namespace audrey\CalendarApp\View\Component;

class Button
{
    public static function render(): void
    { ?>

        <a href="?month=<?= $currentMonth + 1 ?>&year=<?= $currentYear ?>" class="px-4 py-2 bg-fjord-400 text-bone-50 rounded-lg text-lg">Suivant</a>

<?php }
}
