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
        <?= $js ? '<script src="../src/assets/js/' . $js . '.js"></script>' : null ?>

        </body>

        </html>
<?php
    }
}
