<?php

namespace audrey\CalendarApp\View\Component;

class ButtonComponent
{
    public static function render($label, $href, $id, $color, $size): void
    { ?>

        <?php
        $colorClass = $color === 'secondary'
            ? 'bg-bone-200 text-bone-950 hover:bg-bone-300'
            : 'bg-fjord-500 text-fjord-50 hover:bg-fjord-600';
        $sizeClass = $size === 'small'
            ? 'rounded-md'
            : 'text-lg rounded-lg';
        ?>
        <a id="<?= $id ?>" href="<?= $href ?>" class="px-4 py-2 <?= $colorClass ?> <?= $sizeClass ?>"><?= $label ?></a>

<?php }
}
