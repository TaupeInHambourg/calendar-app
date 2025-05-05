import { formatDateTime } from './utils.js';

function openLessonModal(lessonId, dateStr) {
  const modal = document.getElementById('create-lesson-modal');
  const lessonIdInput = document.getElementById('modal-lesson-id');
  const dateInput = document.getElementById('modal-date');
  const startTimeInput = document.getElementById('start-time');
  const endTimeInput = document.getElementById('end-time');

  dateInput.value = dateStr;

  if (lessonId.startsWith('new:')) {
    startTimeInput.value = '08:30';
    endTimeInput.value = '12:30';
    modal.classList.remove('hidden');
  } else {
    lessonIdInput.value = lessonId;
    console.log('Ouverture du modal pour la leçon:', lessonId);
    console.log('Date:', dateStr);

    fetch(`/lesson/${lessonId}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      }
    })
      .then(response => response.json())
      .then(data => {
        if (data) {
          console.log('Détails de la leçon à déplacer:', data);
          // const startDateTime = new Date(data.date_start);
          // const endDateTime = new Date(data.date_end);

          // startTimeInput.value = startDateTime.getHours().toString().padStart(2, '0') + ':' +
          //   startDateTime.getMinutes().toString().padStart(2, '0');
          // endTimeInput.value = endDateTime.getHours().toString().padStart(2, '0') + ':' +
          //   endDateTime.getMinutes().toString().padStart(2, '0');
        } else {
          // Valeurs par défaut en cas d'erreur
          startTimeInput.value = '08:30';
          endTimeInput.value = '12:30';
        }
        modal.classList.remove('hidden');
      })
      .catch(error => {
        console.error('Erreur lors de la récupération des détails de la leçon:', error);
        // Valeurs par défaut en cas d'erreur
        startTimeInput.value = '08:30';
        endTimeInput.value = '12:30';
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

    console.log('Données à envoyer:', {
      lessonValue,
      startDateTime,
      endDateTime
    });

    if (lessonValue.startsWith('new:')) {
      const moduleId = lessonValue.split(':')[1];
      handleCreateLesson(moduleId, startDateTime, endDateTime);
    } else {
      handleUpdateLesson(lessonValue, startDateTime, endDateTime);
    }

    modal.classList.add('hidden');
  });
}

function handleCreateLesson(moduleId, startDateTime, endDateTime) {
  console.log('Création d\'une nouvelle leçon:', moduleId, startDateTime, endDateTime);

  // Utilisez handleDragDrop pour rester cohérent avec votre architecture
  fetch('/drag-drop', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      action: 'createLesson',
      moduleId: moduleId,
      dateStart: startDateTime,
      dateEnd: endDateTime
    })
  })
    .then(response => response.json())
    .then(data => {
      console.log('Réponse création:', data);
      if (data.success) {
        window.location.reload();
      } else {
        alert('Erreur lors de la création: ' + (data.error || 'Erreur inconnue'));
      }
    })
    .catch(error => {
      console.error('Erreur:', error);
      alert('Une erreur est survenue lors de la création de la leçon.');
    });
}

function handleUpdateLesson(lessonId, startDateTime, endDateTime) {
  console.log('Mise à jour de la leçon:', lessonId, startDateTime, endDateTime);

  fetch(`/lesson/${lessonId}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      dateStart: startDateTime,
      dateEnd: endDateTime
    })
  })
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      response.json()
    })
    .then(data => {
      if (!data || data.success) {
        window.location.reload();
      } else {
        alert('Erreur lors de la mise à jour: ' + (data.error || 'Erreur inconnue'));
      }
    })
    .catch(error => {
      console.error('Erreur:', error);
      alert('Une erreur est survenue lors de la mise à jour de la leçon.');
    });
}

export {
  openLessonModal,
  initModal
};