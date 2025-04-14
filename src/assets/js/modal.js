/**
 * modal.js - Gestion des modales
 */

import { getLesson, createLesson, updateLesson } from './api.js';
import { formatDateTime } from './utils.js';

function openLessonModal(lessonId, dateStr) {
  const modal = document.getElementById('create-lesson-modal');
  const lessonIdInput = document.getElementById('modal-lesson-id');
  const dateInput = document.getElementById('modal-date');
  const startTimeInput = document.getElementById('start-time');
  const endTimeInput = document.getElementById('end-time');

  lessonIdInput.value = lessonId;
  dateInput.value = dateStr;

  if (lessonId.startsWith('new:')) {
    startTimeInput.value = '08:30';
    endTimeInput.value = '12:30';
    modal.classList.remove('hidden');
  } else {
    console.log('MODAL', lessonId);
    getLesson(lessonId)
      .then(data => {
        if (data) {
          const startDateTime = new Date(data.date_start);
          const endDateTime = new Date(data.date_end);

          startTimeInput.value = startDateTime.getHours().toString().padStart(2, '0') + ':' +
            startDateTime.getMinutes().toString().padStart(2, '0');
          endTimeInput.value = endDateTime.getHours().toString().padStart(2, '0') + ':' +
            endDateTime.getMinutes().toString().padStart(2, '0');
        } else {
          // Valeurs par défaut en cas d'erreur
          startTimeInput.value = '08:30';
          endTimeInput.value = '12:30';
        }

        modal.classList.remove('hidden');
      });
  }
}

function initModal() {
  const modal = document.getElementById('create-lesson-modal');
  const cancelBtn = document.getElementById('cancel-lesson-time');
  const confirmBtn = document.getElementById('confirm-lesson-time');
  const startTimeInput = document.getElementById('start-time');
  const endTimeInput = document.getElementById('end-time');
  const lessonIdInput = document.getElementById('modal-lesson-id');
  const dateInput = document.getElementById('modal-date');

  if (!modal || !cancelBtn || !confirmBtn) {
    console.error('Modal elements not found');
    return;
  }

  cancelBtn.addEventListener('click', function () {
    modal.classList.add('hidden');
    startTimeInput.value = '';
    endTimeInput.value = '';
    lessonIdInput.value = '';
    dateInput.value = '';
  });

  confirmBtn.addEventListener('click', function () {
    const lessonValue = lessonIdInput.value;
    const date = dateInput.value;
    const startTime = startTimeInput.value;
    const endTime = endTimeInput.value;

    if (!startTime || !endTime) {
      alert('Veuillez spécifier les heures de début et de fin.');
      return;
    }

    const startDateTime = formatDateTime(date, startTime);
    const endDateTime = formatDateTime(date, endTime);

    if (lessonValue.startsWith('new:')) {
      const moduleId = lessonValue.split(':')[1];

      createLesson(moduleId, startDateTime, endDateTime)
        .then(() => {
          window.location.reload();
        })
        .catch(error => {
          console.error('Erreur:', error);
          alert('Une erreur est survenue lors de la création de la leçon.');
        });
    } else {
      updateLesson(lessonValue, startDateTime, endDateTime)
        .then(() => {
          window.location.reload();
        })
        .catch(error => {
          console.error('Erreur:', error);
          alert('Une erreur est survenue lors de la mise à jour de la leçon.');
        });
    }

    modal.classList.add('hidden');
  });
}

export {
  openLessonModal,
  initModal
};