/**
 * home.js - Script principal pour la page d'accueil
 * Initialise toutes les fonctionnalités
 */

import { initDragDrop } from './dragdrop.js';
import { initModal } from './modal.js';
import { toggleModules } from './calendar.js';

// Exposer la fonction toggleModules globalement pour l'utiliser dans le HTML
window.toggleModules = toggleModules;

// Initialise toutes les fonctionnalités de la page d'accueil
document.addEventListener('DOMContentLoaded', function () {
  // Initialiser le drag & drop
  initDragDrop();

  // Initialiser la modale
  initModal();

  // Autres initialisations si nécessaire...
  console.log('Home page initialized');
});