/**
 * modal.js - Gestion des modales
 */

import { getLessonDetails, createLesson, updateLesson } from './api.js';
import { formatDateTime } from './utils.js';

// Fonction pour ouvrir la modale de leçon
function openLessonModal(lessonId, dateStr) {
  const modal = document.getElementById('create-lesson-modal');
  const lessonIdInput = document.getElementById('modal-lesson-id');
  const dateInput = document.getElementById('modal-date');
  const startTimeInput = document.getElementById('start-time');
  const endTimeInput = document.getElementById('end-time');

  lessonIdInput.value = lessonId;
  dateInput.value = dateStr;

  if (lessonId.startsWith('new:')) {
    // Valeurs par défaut pour un nouveau module
    startTimeInput.value = '09:00';
    endTimeInput.value = '12:00';
    modal.classList.remove('hidden');
  } else {
    // Récupérer les détails de la leçon existante
    getLessonDetails(lessonId)
      .then(data => {
        if (data) {
          // Extraire les heures de début et de fin
          const startDateTime = new Date(data.date_start);
          const endDateTime = new Date(data.date_end);

          // Format HH:MM pour les inputs time
          startTimeInput.value = startDateTime.getHours().toString().padStart(2, '0') + ':' +
            startDateTime.getMinutes().toString().padStart(2, '0');
          endTimeInput.value = endDateTime.getHours().toString().padStart(2, '0') + ':' +
            endDateTime.getMinutes().toString().padStart(2, '0');
        } else {
          // Valeurs par défaut en cas d'erreur
          startTimeInput.value = '09:00';
          endTimeInput.value = '12:00';
        }

        // Afficher la modale
        modal.classList.remove('hidden');
      });
  }
}

// Initialise les gestionnaires d'événements pour la modale
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

  // Gérer le clic sur le bouton Annuler
  cancelBtn.addEventListener('click', function () {
    modal.classList.add('hidden');
    // Réinitialiser les valeurs
    startTimeInput.value = '';
    endTimeInput.value = '';
    lessonIdInput.value = '';
    dateInput.value = '';
  });

  // Gérer le clic sur le bouton Confirmer
  confirmBtn.addEventListener('click', function () {
    const lessonValue = lessonIdInput.value;
    const date = dateInput.value;
    const startTime = startTimeInput.value;
    const endTime = endTimeInput.value;

    if (!startTime || !endTime) {
      alert('Veuillez spécifier les heures de début et de fin.');
      return;
    }

    // Formatage des dates complètes
    const startDateTime = formatDateTime(date, startTime);
    const endDateTime = formatDateTime(date, endTime);

    if (lessonValue.startsWith('new:')) {
      // Création d'une nouvelle leçon à partir d'un module
      const moduleId = lessonValue.split(':')[1];

      createLesson(moduleId, startDateTime, endDateTime)
        .then(() => {
          // Rafraîchir la page pour afficher la nouvelle leçon
          window.location.reload();
        })
        .catch(error => {
          console.error('Erreur:', error);
          alert('Une erreur est survenue lors de la création de la leçon.');
        });
    } else {
      // Mise à jour d'une leçon existante
      updateLesson(lessonValue, startDateTime, endDateTime)
        .then(() => {
          // Rafraîchir la page pour afficher les changements
          window.location.reload();
        })
        .catch(error => {
          console.error('Erreur:', error);
          alert('Une erreur est survenue lors de la mise à jour de la leçon.');
        });
    }

    // Fermer la modale
    modal.classList.add('hidden');
  });
}

// Exporte les fonctions
export {
  openLessonModal,
  initModal
};