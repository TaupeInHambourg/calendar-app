<?php

namespace audrey\CalendarApp\View\Modal;

use audrey\CalendarApp\View\Component\ButtonComponent;

class CreateLessonModal
{
    public static function render()
    { ?>
        <div id="create-lesson-modal" class="fixed inset-0 bg-black bg-opacity-95 bg-bone-50 hidden flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                <h3 class="text-xl font-bold mb-4">Modifier l'horaire</h3>
                <input type="hidden" id="modal-lesson-id">
                <input type="hidden" id="modal-date">

                <div class="mb-4">
                    <label for="start-time" class="block text-sm font-medium text-gray-700 mb-1">Heure de début</label>
                    <input type="time" id="start-time" class="w-full p-2 border border-gray-300 rounded">
                </div>

                <div class="mb-4">
                    <label for="end-time" class="block text-sm font-medium text-gray-700 mb-1">Heure de fin</label>
                    <input type="time" id="end-time" class="w-full p-2 border border-gray-300 rounded">
                </div>

                <div class="flex justify-end space-x-3">
                    <?= ButtonComponent::render('Annuler', null, 'cancel-lesson-time', 'secondary', 'small') ?>
                    <?= ButtonComponent::render('Confirmer', null, 'confirm-lesson-time', 'primary', 'small') ?>
                </div>
            </div>
        </div>
<?php
    }
}
