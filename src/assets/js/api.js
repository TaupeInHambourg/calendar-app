/**
 * api.js - Fonctions pour interagir avec l'API
 */

// Récupère la couleur d'une leçon
function getLessonColor(lessonId) {
  return fetch(`/lesson-color/${lessonId}`)
    .then(response => response.json())
    .catch(() => {
      console.error('Erreur lors de la récupération de la couleur');
      return { color: '#3498db' }; // Couleur par défaut
    });
}

// Récupère les détails d'une leçon
function getLesson(lessonId) {
  return fetch(`/api/lesson/${lessonId}`)
    .then(response => response.json())
    .catch(error => {
      console.error('Erreur lors de la récupération des détails de la leçon:', error);
      return null;
    });
}

// Crée une nouvelle leçon à partir d'un module
function createLesson(moduleId, dateStart, dateEnd) {
  return fetch('/api/lessons', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      moduleId: moduleId,
      dateStart: dateStart,
      dateEnd: dateEnd
    })
  })
    .then(response => {
      if (!response.ok) throw new Error('Erreur lors de la création de la leçon');
      return response.json();
    });
}

// Met à jour une leçon existante
function updateLesson(lessonId, dateStart, dateEnd) {
  return fetch(`/api/lessons/${lessonId}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      dateStart: dateStart,
      dateEnd: dateEnd
    })
  })
    .then(response => {
      if (!response.ok) throw new Error('Erreur lors de la mise à jour de la leçon');
      return response.json();
    });
}

// Gère le drag & drop avec l'API
function handleDragDrop(action, data) {
  return fetch('/drag-drop', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      action: action,
      ...data
    })
  })
    .then(response => response.json());
}

// Exporte les fonctions
export {
  getLessonColor,
  getLesson,
  createLesson,
  updateLesson,
  handleDragDrop
};