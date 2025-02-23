<?php

namespace audrey\CalendarApp\View\Component;

class ModuleComponent
{
    public static function render($modules)
    {
?>
        <div class="modules">
            <?php foreach ($modules as $module): ?>
                <div class="module" style="border: 2px solid <?= $module['color'] ?>; background-color: <?= $module['attributed'] == $module['allowed'] ? 'transparent' : $module['color'] ?>; padding: 10px; border-radius: 4px; margin-bottom: 10px;">
                    <div class="module-name"><?= $module['name'] ?></div>
                    <div class="module-details">
                        <span><?= $module['attributed'] ?>h attribuées</span>
                        <span><?= $module['allowed'] ?>h allouées</span>
                        <span>delta <?= $module['allowed'] - $module['attributed'] ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
<?php
    }
}
