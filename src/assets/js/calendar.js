/**
 * calendar.js - Fonctionnalités du calendrier
 */

import { getLessonColor } from './api.js';

// Affiche une leçon dans le calendrier
function renderLessonComponent(lesson, container) {
  // Crée un nouvel élément de leçon
  const lessonElement = document.createElement('div');
  lessonElement.className = 'lesson event-list p-1 mt-2 rounded-lg overflow-y-auto min-h-fit';
  lessonElement.setAttribute('data-lesson-id', lesson.id);

  // Récupère la couleur depuis le serveur
  getLessonColor(lesson.id)
    .then(data => {
      lessonElement.style.backgroundColor = data.color;
    });

  // Ajoute le nom de la leçon
  const lessonName = document.createElement('div');
  lessonName.className = 'text-sm rounded p-1 mt-1';
  lessonName.textContent = lesson.name;

  lessonElement.appendChild(lessonName);

  // Remplace le conteneur par le nouvel élément de leçon
  if (container && container.parentNode) {
    container.parentNode.replaceChild(lessonElement, container);
  } else {
    console.error('Container is not valid for replacement');
  }

  return lessonElement;
}

// Fonction pour basculer l'affichage de la section des modules
function toggleModules(button) {
  const modules = document.getElementById('modules_section');
  modules.classList.toggle('hidden');

  const icon = button.querySelector('#eyeIcon');
  if (icon.src.includes('eye-opened-fill.svg')) {
    icon.src = 'src/assets/icons/eye-closed-outline.svg';
  } else {
    icon.src = 'src/assets/icons/eye-opened-fill.svg';
  }

  const calendarWrapper = document.querySelector('.container div:first-of-type');
  if (calendarWrapper.classList.contains('w-11/12')) {
    calendarWrapper.classList.replace('w-11/12', 'w-4/5');
  } else {
    calendarWrapper.classList.replace('w-4/5', 'w-11/12');
  }

  const modulesWrapper = document.querySelector('.container div:last-of-type');
  if (modulesWrapper.classList.contains('w-fit')) {
    modulesWrapper.classList.replace('w-fit', 'w-1/5');
  } else {
    modulesWrapper.classList.replace('w-1/5', 'w-fit');
  }
}

// Exporte les fonctions
export {
  renderLessonComponent,
  toggleModules
};