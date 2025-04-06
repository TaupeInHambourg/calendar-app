/**
 * dragdrop.js - Gestion du drag & drop
 */

import { handleDragDrop } from './api.js';
import { getDateFromCalendarCell } from './utils.js';
import { openLessonModal } from './modal.js';
import { renderLessonComponent } from './calendar.js';

// Initialise Sortable pour les modules
function initModulesSortable() {
  const modulesList = document.querySelector('.modules');
  if (!modulesList) return;

  Sortable.create(modulesList, {
    group: {
      name: 'modules',
      pull: 'clone',
      put: false
    },
    sort: false,
    onClone: function (evt) {
      const item = evt.item;
      const moduleId = item.getAttribute('data-module-id');
      item.classList.add('module-clone');
      item.setAttribute('data-dragged-module-id', moduleId);
    }
  });
}

// Initialise Sortable pour les jours du calendrier
function initCalendarSortable() {
  document.querySelectorAll('.calendar').forEach(calendarDay => {
    Sortable.create(calendarDay, {
      group: {
        name: 'lessons',
        put: ['modules', 'lessons']
      },
      onAdd: function (evt) {
        const item = evt.item;
        const targetDate = getDateFromCalendarCell(evt.to).dateTimeStr;

        if (item.classList.contains('module-clone')) {
          // Gestion du drag & drop d'un module vers le calendrier
          const moduleId = item.getAttribute('data-dragged-module-id');

          handleDragDrop('createLesson', {
            moduleId: moduleId,
            date: targetDate
          })
            .then(data => {
              if (data.success) {
                // Remplace le module cloné par la leçon
                renderLessonComponent(data.lesson, item);
              } else {
                console.error('Failed to create lesson:', data.error);
                item.remove(); // Supprime le clone en cas d'échec
              }
            })
            .catch(error => {
              console.error('Error:', error);
              item.remove();
            });
        } else {
          // Gestion du déplacement d'une leçon existante
          const lessonId = item.getAttribute('data-lesson-id');

          handleDragDrop('moveLesson', {
            lessonId: lessonId,
            newDate: targetDate
          })
            .then(data => {
              if (!data.success) {
                console.error('Failed to update lesson:', data.error);
                // Gestion du retour en position initiale
              }
            })
            .catch(error => {
              console.error('Error:', error);
            });
        }
      }
    });
  });
}

// Initialise le drag & drop natif pour les modules
function initNativeDragDrop() {
  let draggedElement = null;
  let originalParent = null;

  // Pour les modules
  const moduleElements = document.querySelectorAll('.module');
  moduleElements.forEach(module => {
    module.setAttribute('draggable', 'true');
    module.addEventListener('dragstart', function (e) {
      e.dataTransfer.setData('text/plain', 'module:' + this.getAttribute('data-module-id'));
      e.dataTransfer.effectAllowed = 'copy';
    });
  });

  // Pour les leçons existantes
  const lessonElements = document.querySelectorAll('.lesson');
  lessonElements.forEach(lesson => {
    lesson.setAttribute('draggable', 'true');
    lesson.addEventListener('dragstart', function (e) {
      e.dataTransfer.setData('text/plain', 'lesson:' + this.getAttribute('data-lesson-id'));
      draggedElement = this;
      originalParent = this.parentNode;
      e.dataTransfer.effectAllowed = 'move';
    });
  });

  // Zones de drop (jours du calendrier)
  const calendarDays = document.querySelectorAll('.calendar');
  calendarDays.forEach(day => {
    day.addEventListener('dragover', function (e) {
      e.preventDefault();
      e.dataTransfer.dropEffect = 'move';
      this.classList.add('bg-bone-200'); // Mise en évidence au survol
    });

    day.addEventListener('dragleave', function () {
      this.classList.remove('bg-bone-200');
    });

    day.addEventListener('drop', function (e) {
      e.preventDefault();
      this.classList.remove('bg-bone-200');

      const data = e.dataTransfer.getData('text/plain');
      const [type, id] = data.split(':');

      // Récupérer la date du jour du calendrier
      const { dateStr } = getDateFromCalendarCell(this);

      if (type === 'lesson') {
        // Pour une leçon existante, on ouvre la modale
        openLessonModal(id, dateStr);
      } else if (type === 'module') {
        // Pour un nouveau module, on ouvre également la modale
        openLessonModal('new:' + id, dateStr);
      }
    });
  });
}

// Initialise tous les systèmes de drag & drop
function initDragDrop() {
  // Choisir entre Sortable et le drag & drop natif
  const useSortable = true;

  if (useSortable) {
    initModulesSortable();
    initCalendarSortable();
  } else {
    initNativeDragDrop();
  }
}

// Exporte les fonctions
export {
  initDragDrop
};
