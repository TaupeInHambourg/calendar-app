<?php

namespace audrey\CalendarApp\View\Layout;

class Footer
{
    public function render($js = null)
    {

?>
        <hr>
        <p>START-FOOTER</p>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
        <?php if ($js): ?>
            <script type="module" src="../src/assets/js/<?= $js ?>.js"></script>
        <?php endif; ?>

        </body>

        </html>
<?php
    }
}
