<?php

namespace audrey\CalendarApp\View\Component;

use audrey\CalendarApp\Model\ModuleModel;

class ModuleComponent
{
    public static function render($modules)
    {
?>
        <div class="modules">

            <?php
            foreach ($modules as $module): ?>
                <div class="module" style="border: 2px solid <?= $module->color ?>; background-color: <?= $module->hours_attributed == $module->hours_allowed ? 'transparent' : $module->color ?>; padding: 10px; border-radius: 4px; margin-bottom: 10px;">
                    <div class="module-name"><?= $module->name ?></div>
                    <div class="module-details">
                        <span><?= $module->hours_attributed ?>h attribuées</span>
                        <span><?= $module->hours_allowed ?>h allouées</span>
                        <span class="bg-mint-500">delta <?= $module->hours_allowed - $module->hours_attributed ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
<?php
    }
}
