/**
 * dragdrop.js - Gestion du drag & drop avec Sortable
 */

import { handleDragDrop } from './api.js';
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
        const targetDate = getDateFromCalendarCell(evt.to).dateTimeStr;

        if (item.classList.contains('module-clone')) {
          const moduleId = item.getAttribute('data-dragged-module-id');
          openLessonModal('new:' + moduleId, targetDate.dateStr);

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
          openLessonModal(lessonId, targetDate.dateStr);

          // handleDragDrop('moveLesson', {
          //   lessonId: lessonId,
          //   newDate: targetDate.dateTimeStr
          // })
          //   .then(data => {
          //     if (data.success) {
          //       openLessonModal(lessonId, newDate.dateStr);
          //     } else {
          //       console.error('Failed to update lesson:', data.error);
          //     }
          //   })
          //   .catch(error => {
          //     console.error('Error:', error);
          //   });
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