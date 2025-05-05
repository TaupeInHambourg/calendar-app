import { getDateFromCalendarCell } from './utils.js';
import { renderLessonComponent } from './calendar.js';
import { openLessonModal } from './modal.js';

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

function initCalendarSortable() {
  document.querySelectorAll('.calendar').forEach(calendarDay => {
    Sortable.create(calendarDay, {
      group: {
        name: 'lessons',
        put: ['modules', 'lessons']
      },
      animation: 150,
      onAdd: function (evt) {
        const item = evt.item;
        const targetDate = getDateFromCalendarCell(evt.to);

        if (item.classList.contains('module-clone')) {
          const moduleId = item.getAttribute('data-dragged-module-id');
          openLessonModal('new:' + moduleId, targetDate);

          item.remove();
          // handleDragDrop('createLesson', {
          //   moduleId: moduleId,
          //   date: targetDate
          // })
          //   .then(data => {
          //     if (data.success) {
          //       renderLessonComponent(data.lesson, item);
          //     } else {
          //       console.error('Failed to create lesson:', data.error);
          //       item.remove();
          //     }
          //   })
          //   .catch(error => {
          //     console.error('Error:', error);
          //     item.remove();
          //   });
        } else {
          const lessonId = item.getAttribute('data-lesson-id');
          const targetDate = getDateFromCalendarCell(evt.to);
          openLessonModal(lessonId, targetDate);

          // Mise à jour directe de la date de la leçon
          fetch('/drag-drop', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              action: 'moveLesson',
              lessonId: lessonId,
              newDate: targetDate.dateTimeStr
            })
          })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                // Succès silencieux - l'élément est déjà déplacé visuellement
              } else {
                console.error('Failed to update lesson:', data.error);
                // Annuler le déplacement visuel si besoin
                evt.from.appendChild(item);
              }
            })
            .catch(error => {
              console.error('Error:', error);
              // Annuler le déplacement visuel en cas d'erreur
              evt.from.appendChild(item);
            });
        }
      }
    });
  });
}

function initDragDrop() {
  initModulesSortable();
  initCalendarSortable();
}

export {
  initDragDrop
};