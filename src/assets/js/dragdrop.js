import { getDateFromCalendarCell } from './utils.js';
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
        } else {
          const lessonId = item.getAttribute('data-lesson-id');
          const targetDate = getDateFromCalendarCell(evt.to);
          openLessonModal(lessonId, targetDate);
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