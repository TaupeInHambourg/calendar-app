function toggleModules(button) {
  const modules = document.getElementById('modules_section');
  modules.classList.toggle('hidden');

  const icon = button.querySelector('#eyeIcon');
  if (icon.src.includes('eye-opened-fill.svg')) {
    icon.src = 'src/assets/icons/eye-closed-outline.svg';
  } else {
    icon.src = 'src/assets/icons/eye-opened-fill.svg';
  }

  const calendarWrapper = document.querySelector('.container div:first-of-type')
  if (calendarWrapper.classList.contains('w-11/12')) {
    calendarWrapper.classList.replace('w-11/12', 'w-4/5')
  } else {
    calendarWrapper.classList.replace('w-4/5', 'w-11/12')
  }

  const modulesWrapper = document.querySelector('.container div:last-of-type')
  if (modulesWrapper.classList.contains('w-fit')) {
    modulesWrapper.classList.replace('w-fit', 'w-1/5')
  } else {
    modulesWrapper.classList.replace('w-1/5', 'w-fit')
  }
}

document.addEventListener('DOMContentLoaded', function () {
  // Modal elements
  const modal = document.getElementById('lesson-time-modal');
  const cancelBtn = document.getElementById('cancel-lesson-time');
  const confirmBtn = document.getElementById('confirm-lesson-time');
  const startTimeInput = document.getElementById('start-time');
  const endTimeInput = document.getElementById('end-time');
  const lessonIdInput = document.getElementById('modal-lesson-id');
  const dateInput = document.getElementById('modal-date');

  let draggedElement = null;
  let originalParent = null;

  // Gestion du Drag & Drop pour les modules
  const moduleElements = document.querySelectorAll('.module');
  moduleElements.forEach(module => {
    module.setAttribute('draggable', 'true');
    module.addEventListener('dragstart', function (e) {
      e.dataTransfer.setData('text/plain', 'module:' + this.getAttribute('data-module-id'));
      e.dataTransfer.effectAllowed = 'copy';
    });
  });

  // Gestion du Drag & Drop pour les lessons existantes
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

  // Zones de drop (les jours du calendrier)
  const calendarDays = document.querySelectorAll('.calendar');
  calendarDays.forEach(day => {
    day.addEventListener('dragover', function (e) {
      e.preventDefault();
      e.dataTransfer.dropEffect = 'move';
      this.classList.add('bg-bone-200'); // Highlight on dragover
    });

    day.addEventListener('dragleave', function () {
      this.classList.remove('bg-bone-200');
    });

    day.addEventListener('drop', function (e) {
      e.preventDefault();
      this.classList.remove('bg-bone-200');

      const data = e.dataTransfer.getData('text/plain');
      const [type, id] = data.split(':');

      // Récupération de la date du jour du calendrier
      const dayNumber = this.querySelector('.day').textContent.trim();
      const monthYear = document.querySelector('.text-2xl.font-bold').textContent.trim();
      const [monthName, year] = monthYear.split(' ');

      // Conversion du nom du mois en numéro
      const months = {
        'Janvier': '01', 'Février': '02', 'Mars': '03', 'Avril': '04',
        'Mai': '05', 'Juin': '06', 'Juillet': '07', 'Août': '08',
        'Septembre': '09', 'Octobre': '10', 'Novembre': '11', 'Décembre': '12'
      };

      const month = months[monthName];
      const formattedDay = dayNumber.padStart(2, '0');
      const dateStr = `${year}-${month}-${formattedDay}`;

      if (type === 'lesson') {
        // Pour une leçon existante, on ouvre la modal pour ajuster l'heure
        lessonIdInput.value = id;
        dateInput.value = dateStr;

        // Récupérer l'heure actuelle de la leçon via une requête AJAX
        fetch(`/api/lesson/${id}`)
          .then(response => response.json())
          .then(data => {
            // Extraire les heures de début et de fin
            const startDateTime = new Date(data.date_start);
            const endDateTime = new Date(data.date_end);

            // Format HH:MM pour les inputs time
            startTimeInput.value = startDateTime.getHours().toString().padStart(2, '0') + ':' +
              startDateTime.getMinutes().toString().padStart(2, '0');
            endTimeInput.value = endDateTime.getHours().toString().padStart(2, '0') + ':' +
              endDateTime.getMinutes().toString().padStart(2, '0');

            // Afficher la modal
            modal.classList.remove('hidden');
          })
          .catch(error => {
            console.error('Erreur lors de la récupération des détails de la leçon:', error);
            // Valeurs par défaut en cas d'erreur
            startTimeInput.value = '09:00';
            endTimeInput.value = '12:00';
            modal.classList.remove('hidden');
          });
      } else if (type === 'module') {
        // Pour un nouveau module, on ouvre également la modal
        lessonIdInput.value = 'new:' + id; // Format spécial pour identifier une nouvelle leçon
        dateInput.value = dateStr;

        // Valeurs par défaut pour un nouveau module
        startTimeInput.value = '09:00';
        endTimeInput.value = '12:00';
        modal.classList.remove('hidden');
      }
    });
  });

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
    const startDateTime = `${date} ${startTime}:00`;
    const endDateTime = `${date} ${endTime}:00`;

    if (lessonValue.startsWith('new:')) {
      // Création d'une nouvelle leçon à partir d'un module
      const moduleId = lessonValue.split(':')[1];

      fetch('/api/lessons', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          moduleId: moduleId,
          dateStart: startDateTime,
          dateEnd: endDateTime
        })
      })
        .then(response => {
          if (!response.ok) throw new Error('Erreur lors de la création de la leçon');
          return response.json();
        })
        .then(data => {
          // Rafraîchir la page pour afficher la nouvelle leçon
          window.location.reload();
        })
        .catch(error => {
          console.error('Erreur:', error);
          alert('Une erreur est survenue lors de la création de la leçon.');
        });
    } else {
      // Mise à jour d'une leçon existante
      const lessonId = lessonValue;

      fetch(`/api/lessons/${lessonId}`, {
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
          if (!response.ok) throw new Error('Erreur lors de la mise à jour de la leçon');
          return response.json();
        })
        .then(data => {
          // Rafraîchir la page pour afficher les changements
          window.location.reload();
        })
        .catch(error => {
          console.error('Erreur:', error);
          alert('Une erreur est survenue lors de la mise à jour de la leçon.');
        });
    }

    // Fermer la modal
    modal.classList.add('hidden');
  });
});