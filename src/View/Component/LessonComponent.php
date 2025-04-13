<?php

namespace audrey\CalendarApp\View\Component;

use audrey\CalendarApp\Model\LessonModel;

class LessonComponent
{
    public static function render($lesson)
    {
        $h_start = explode(' ', $lesson->date_start);
        $formatted_start = explode(':', $h_start[1]);
        $h_end = explode(' ', $lesson->date_end);
        $formatted_end = explode(':', $h_end[1]);
?>
        <div class="lesson event-list p-1 mt-2 rounded-lg overflow-y-auto min-h-fit"
            data-lesson-id="<?= $lesson->id ?>"
            style="background-color: <?php echo LessonModel::getLessonColor($lesson->id)[0]->color ?>;">
            <div class="text-sm rounded p-1 mt-1">
                <p><?= htmlspecialchars($lesson->name) ?></p>
                <p><?= $formatted_start[0] ?>h<?= $formatted_start[1] ?> - <?= $formatted_end[0] ?>h<?= $formatted_end[1] ?></p>
            </div>
        </div>
<?php }
}
