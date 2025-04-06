<?php

namespace audrey\CalendarApp\View\Component;

use audrey\CalendarApp\Model\LessonModel;

class LessonComponent
{
    public static function render($lesson)
    { ?>
        <div class="lesson event-list p-1 mt-2 rounded-lg overflow-y-auto min-h-fit"
            data-lesson-id="<?= $lesson->id ?>"
            style="background-color: <?php echo LessonModel::getLessonColor($lesson->id)[0]->color ?>;">
            <div class="text-sm rounded p-1 mt-1">
                <?= htmlspecialchars($lesson->name) ?>
            </div>
        </div>
<?php }
}
