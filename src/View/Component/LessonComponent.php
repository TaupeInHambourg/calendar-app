<?php

namespace audrey\CalendarApp\View\Component;

use audrey\CalendarApp\Model\LessonModel;

class LessonComponent
{
    public static function render($lesson)
    { ?>

        <div class="text-sm bg-[<?= LessonModel::getLessonColor($lesson->id)[0]->color; ?>] rounded p-1 mt-1">
            <?= htmlspecialchars($lesson->name) ?>
        </div>

<?php }
}
